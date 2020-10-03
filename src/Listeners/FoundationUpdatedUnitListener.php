<?php

namespace Wiltechs\Foundation\Listeners;

use App\Events\FoundationUpdatedUnitEvent;
use App\Mappings\UnitMapping;
use App\Models\Unit;

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
