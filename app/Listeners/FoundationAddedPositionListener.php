<?php

namespace App\Listeners;

use App\Events\FoundationAddedPositionEvent;
use App\Models\Position;
use App\Mappings\PositionMapping;

class FoundationAddedPositionListener
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
     * @param  FoundationAddedPositionEvent  $event
     * @return void
     */
    public function handle(FoundationAddedPositionEvent $event)
    {
        Position::create(PositionMapping::initToModel($event->data));
    }
}
