<?php

namespace App\Listeners;

use App\Events\FoundationDeletedUnitEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class FoundationDeletedUnitListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  FoundationDeletedUnitEvent  $event
     * @return void
     */
    public function handle(FoundationDeletedUnitEvent $event)
    {
        //
    }
}
