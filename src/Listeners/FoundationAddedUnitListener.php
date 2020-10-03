<?php

namespace Wiltechs\Foundation\Listeners;

use Wiltechs\Foundation\Events\FoundationAddedUnitEvent;
use Wiltechs\Foundation\Mappings\UnitMapping;
use Wiltechs\Foundation\Models\Unit;

class FoundationAddedUnitListener
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
     * @param  FoundationAddedUnitEvent  $event
     * @return void
     */
    public function handle(FoundationAddedUnitEvent $event)
    {
        Unit::create(UnitMapping::initToModel($event->data));
    }
}
