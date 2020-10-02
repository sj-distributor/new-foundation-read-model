<?php

namespace App\Listeners;

use App\Events\FoundationAddedStaffEvent;
use App\Mappings\StaffMapping;
use App\Models\Staff;


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
