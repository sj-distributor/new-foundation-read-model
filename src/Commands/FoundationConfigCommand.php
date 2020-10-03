<?php

namespace Wiltechs\Foundation\Commands;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;


class FoundationConfigCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'foundation:config';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Foundation Get Config';

    /**
     * Handle
     *
     */
    public function handle()
    {
        copy(
            __DIR__.'/stubs/config/foundation.php',
            base_path('config/foundation.php')
        );

        $this->info('successfully.');
    }


}