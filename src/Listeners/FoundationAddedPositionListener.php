<?php

namespace Wiltechs\Foundation\Listeners;

use Wiltechs\Foundation\Events\FoundationAddedPositionEvent;
use Wiltechs\Foundation\Models\Position;
use Wiltechs\Foundation\Mappings\PositionMapping;

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
