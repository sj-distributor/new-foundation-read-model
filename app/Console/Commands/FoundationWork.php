<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class FoundationWork extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'FoundationWork';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    public $exchangeMaps = [
        'NewFoundationInitialisedAllOrganisationStructuresEvent' => \App\Events\FoundationInitdOrganisationEvent::class,
        'NewFoundationInitialisedAllPositionsStructuresEvent' => \App\Events\FoundationInitPositionEvent::class,
        'NewFoundationInitialisedAllStaffsEvent' => \App\Events\FoundationInitStaffEvent::class,
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ini_set("memory_limit", "1024M");

        $queue = 'pick_mistake';

        $consumerTag = 'consumer-' . getmypid();

        $connection = new AMQPStreamConnection(
            'mq-001.service.wiltechs.cn',
            5672,
            'justim',
            'justim',
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

          
         //   $callback->delivery_info['channel']->basic_ack($callback->delivery_info['delivery_tag']); // 正常拿到消息后对RabbitMQ ack 回复
            
            $body = $callback->body;
    
            $bodyData = json_decode($body, true);
            
            $exchange = $this->exchangeMaps[$this->getExchangeName($bodyData['messageType'][0])];
            
            if ($bodyData['messageType'][0] == 'urn:message:HR.Foundation.Messages.Events:NewFoundationInitialisedAllStaffsEvent') {
                $callback->delivery_info['channel']->basic_ack($callback->delivery_info['delivery_tag']);
            }

            echo "[start] ".$exchange.PHP_EOL;
            
            event(new $exchange($bodyData['message']));

            echo "[end] ".$exchange.PHP_EOL;

            
           
        } catch (\Exception $e) {
           echo "[error] ".$exchange.PHP_EOL.$e->getMessage(). $e->getFile().$e->getLine().PHP_EOL;
        }
       
    }

    private function getExchangeName(string $mesage): string
    {
       $arr = explode(':', $mesage);
       return array_pop($arr);
    }
}
