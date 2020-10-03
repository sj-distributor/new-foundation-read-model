<?php

namespace Wiltechs\Foundation\Listeners;

use Wiltechs\Foundation\Events\FoundationDeletedUnitEvent;
use Wiltechs\Foundation\Models\Unit;

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
        Unit::where('id', $event->entityId)->delete();
    }
}
