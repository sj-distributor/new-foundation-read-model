<?php

namespace App\Listeners;

use App\Events\FoundationDeletedPositionEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Position;

class FoundationDeletedPositionListener
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
     * @param  FoundationDeletedPositionEvent  $event
     * @return void
     */
    public function handle(FoundationDeletedPositionEvent $event)
    {
        Position::where('id', $event->id)->delete();
    }
}
