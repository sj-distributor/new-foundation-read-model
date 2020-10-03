<?php

namespace Wiltechs\Foundation\Listeners;

use Wiltechs\Foundation\Events\FoundationUpdatedUnitEvent;
use Wiltechs\Foundation\Mappings\UnitMapping;
use Wiltechs\Foundation\Models\Unit;

class FoundationUpdatedUnitListener
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
     * @param  FoundationUpdatedUnitEvent  $event
     * @return void
     */
    public function handle(FoundationUpdatedUnitEvent $event)
    {
        $unit = UnitMapping::updateToModel($event->data);
        Unit::where('id', $unit['id'])->update($unit);
    }
}
