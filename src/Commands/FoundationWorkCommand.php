<?php

namespace Wiltechs\Foundation\Commands;

use Exception;
use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Illuminate\Support\Facades\Log;
use Wiltechs\Foundation\Logger\LoggerHandler;

class FoundationWorkCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'foundation:work';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private $loggerhandler;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->loggerhandler = new LoggerHandler();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ini_set("memory_limit", "1024M");

        $queue = config('foundation.queue_name');

        $consumerTag = 'consumer-' . getmypid();

        $connection = new AMQPStreamConnection(
            config('foundation.host'),
            config('foundation.port'),
            config('foundation.user'),
            config('foundation.password'),
            '/',
            false,
            'AMQPLAIN',
            null,
            'en_US',
            120,
            120,
            null,
            false,
            60
        );

        $channel = $connection->channel();

        $channel->queue_declare($queue, true, false, true, false);

        $channel->basic_qos(0, 1, false);

        $channel->basic_consume($queue, $consumerTag, false, false, false, false, function ($e) {
            $this->callback($e);
        });

        while (count($channel->callbacks)) {
            $channel->wait();
        }

        $channel->close();

        $connection->close();
    }

    private function callback($callback)
    {
        try {

          
            $callback->delivery_info['channel']->basic_ack($callback->delivery_info['delivery_tag']); // 正常拿到消息后对RabbitMQ ack 回复
            
            $body = $callback->body;
    
            $bodyData = json_decode($body, true);
            
            $exchange = $this->getExchangeName($bodyData['messageType'][0]);

           
            $this->loggerhandler->messageQueueLog($exchange, $bodyData);
            
            $this->info("[start] " .date('Y-m-d H:i:s').$exchange);
           
            event(new $exchange($bodyData['message']));

            $this->info("[end] ".date('Y-m-d H:i:s').$exchange);
           
        } catch (\Exception $e) {
            $this->error ("[error] ".date('Y-m-d H:i:s').$exchange);

            $this->loggerhandler->messageQueueLog($callback->delivery_info['exchange'], $e->getMessage(). $e->getFile().$e->getLine());

            if (config('foundation.rabbitmq_queue_error')) {
                $this->publishError($callback->delivery_info['channel'], $exchange, $bodyData, $e);
            }
        }
       
    }

    private function getExchangeName(string $mesage): string
    {
       try {

            $exchanges = config('foundation.exchangeMaps');

            $arr = explode(':', $mesage);

            return  $exchanges[array_pop($arr)];

       } catch (\Exception $e) {
            throw new Exception('can not found exchage');
       }
      
    }

     /**
     * 将错误的消息发送的error队列
     * @param $channel
     * @param array $bodyData
     * @param \Exception $error
     */
    private function publishError($channel, $exchange, array $bodyData, \Exception $error)
    {
        $channel->exchange_declare(config('foundation.rabbitmq_queue_error'), 'direct', false, true, false);

        $channel->queue_bind(config('foundation.rabbitmq_queue_error'), config('foundation.rabbitmq_queue_error'));

        $bodyData["error"] = [
            "code" => $error->getCode(),
            "file" => $error->getFile(),
            "line" => $error->getLine(),
            "trace" => $error->getTraceAsString()
        ];

        $message = new AMQPMessage(
            json_encode(
                [
                    'content' => $bodyData,
                    'exchange' => $exchange
                ]
            ), 
            array('content_type' => 'application/json', 
            'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
        );

        $channel->basic_publish($message, config('foundation.rabbitmq_queue_error'));
    }
}
