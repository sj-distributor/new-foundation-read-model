<?php

namespace App\Listeners;

use App\Events\FoundationUpdatedPositionEvent;
use App\Models\Position;
use App\Mappings\PositionMapping;

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
