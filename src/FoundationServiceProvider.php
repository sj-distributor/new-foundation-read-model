<?php

namespace Wiltechs\Foundation;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Wiltechs\Foundation\Commands\FoundationWorkCommand;
use Wiltechs\Foundation\Commands\FoundationMakeCommand;
use Wiltechs\Foundation\Commands\FoundationConfigCommand;

class FoundationServiceProvider extends ServiceProvider
{
    public function boot()
    {
       
        $this->eventBoot(); //事件监听绑定
    }

    public function register()
    {
        
        $this->mergeConfigFrom(__DIR__.'/config/foundation.php', 'foundation');

        $this->app->singleton('foundation:work',FoundationWorkCommand::class);

        $this->commands(['foundation:work']);

        $this->app->singleton('foundation:make', function() {
            return new FoundationMakeCommand();
        });
        $this->commands([
            'foundation:make'
        ]);

        $this->app->singleton('foundation:config', function() {
            return new FoundationConfigCommand();
        });
        $this->commands([
            'foundation:config'
        ]);

        $this->bindEvents();
    }


    private function bindEvents()
    {
        foreach (config('foundation.events') as $key => $className)
        {
            $this->app->bind($key,$className);
        }
    }


    /**
     * 批量绑定事件监听
     */
    public function eventBoot()
    {
        foreach (config('foundation.listeners') as $event => $listeners)
        {
            foreach ($listeners as $listener)
            {
                Event::listen($event, $listener);
            }
        }
    }
}