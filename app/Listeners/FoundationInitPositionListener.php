<?php

namespace App\Listeners;

use App\Events\FoundationInitPositionEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class FoundationInitPositionListener
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
     * @param  FoundationInitPositionEvent  $event
     * @return void
     */
    public function handle(FoundationInitPositionEvent $event)
    {
        //
    }
}
