<?php

namespace Wiltechs\Foundation\Listeners;

use Wiltechs\Foundation\Events\FoundationUpdatedPositionEvent;
use Wiltechs\Foundation\Models\Position;
use Wiltechs\Foundation\Mappings\PositionMapping;

class FoundationUpdatedPositionListener
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
     * @param  FoundationUpdatedPositionEvent  $event
     * @return void
     */
    public function handle(FoundationUpdatedPositionEvent $event)
    {
        $position = PositionMapping::initToModel($event->data);
        Position::where('id', $position['id'])->update($position);
    }
}
