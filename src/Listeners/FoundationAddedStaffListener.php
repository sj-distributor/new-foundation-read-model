<?php

namespace Wiltechs\Foundation\Listeners;

use Wiltechs\Foundation\Events\FoundationAddedStaffEvent;
use Wiltechs\Foundation\Mappings\StaffMapping;
use Wiltechs\Foundation\Models\Staff;


class FoundationAddedStaffListener
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
     * @param  FoundationAddedStaffEvent  $event
     * @return void
     */
    public function handle(FoundationAddedStaffEvent $event)
    {
        Staff::create(StaffMapping::initToModel($event->data));
    }
}
