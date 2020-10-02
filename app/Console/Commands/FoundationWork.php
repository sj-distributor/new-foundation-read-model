<?php

namespace App\Console\Commands;

use Error;
use Exception;
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
        'StaffAddedEvent' => \App\Events\FoundationAddedStaffEvent::class,
        'StaffUpdatedEvent' => \App\Events\FoundationUpdatedStaffEvent::class,
        'PositionCreatedEvent' => \App\Events\FoundationAddedPositionEvent::class,
        'PositionUpdatedEvent' => \App\Events\FoundationUpdatedPositionEvent::class,
        'PositionDeletedEvent' => \App\Events\FoundationDeletedPositionEvent::class,
        'OrganisationStructureSimpleCreatedEvent' => \App\Events\FoundationAddedUnitEvent::class,
        'OrganisationStructureSimpleUpdatedEvent' => \App\Events\FoundationUpdatedUnitEvent::class,
        'OrganisationStructureDeletedEvent' => \App\Events\FoundationDeletedUnitEvent::class
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

        $queue = config('foundation.queue_name');

        $consumerTag = 'consumer-' . getmypid();

        $connection = new AMQPStreamConnection(
            config('foundation.host'),
            5672,
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

          
         //   $callback->delivery_info['channel']->basic_ack($callback->delivery_info['delivery_tag']); // 正常拿到消息后对RabbitMQ ack 回复
            
            $body = $callback->body;
    
            $bodyData = json_decode($body, true);
            
            $exchange = $this->getExchangeName($bodyData['messageType'][0]);
            
            $writeList = [
                'urn:message:HR.Foundation.Messages.Events:NewFoundationInitialisedAllOrganisationStructuresEvent',
                'urn:message:HR.Foundation.Messages.Events:NewFoundationInitialisedAllPositionsStructuresEvent',
                'urn:message:HR.Foundation.Messages.Events:NewFoundationInitialisedAllStaffsEvent',
                'urn:message:HR.Foundation.Messages.Events:StaffAddedEvent',
                'urn:message:HR.Foundation.Messages.Events:StaffUpdatedEvent',
                'urn:message:HR.Foundation.Messages.Events:PositionCreatedEvent',
                'urn:message:HR.Foundation.Messages.Events:PositionUpdatedEvent',
                'urn:message:HR.Foundation.Messages.Events:PositionDeletedEvent',
                'urn:message:HR.Foundation.Messages.Events:OrganisationStructureSimpleCreatedEvent',
                'urn:message:HR.Foundation.Messages.Events:OrganisationStructureSimpleUpdatedEvent',
                'urn:message:HR.Foundation.Messages.Events:OrganisationStructureDeletedEvent'
            ];
           
            if (in_array($bodyData['messageType'][0], $writeList)) {
                $callback->delivery_info['channel']->basic_ack($callback->delivery_info['delivery_tag']);
            }

            echo "[start] ".$exchange.PHP_EOL;
            file_put_contents(time().'a.json', json_encode($bodyData['message']));
            event(new $exchange($bodyData['message']));

            echo "[end] ".$exchange.PHP_EOL;
           
        } catch (\Exception $e) {
           echo "[error] ".$exchange.PHP_EOL.$e->getMessage(). $e->getFile().$e->getLine().PHP_EOL;
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
