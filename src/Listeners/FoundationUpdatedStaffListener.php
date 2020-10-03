<?php

namespace Wiltechs\Foundation\Listeners;

use Wiltechs\Foundation\Events\FoundationUpdatedStaffEvent;
use Wiltechs\Foundation\Mappings\StaffMapping;
use Wiltechs\Foundation\Models\Staff;

class FoundationUpdatedStaffListener
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
     * @param  FoundationUpdatedStaffEvent  $event
     * @return void
     */
    public function handle(FoundationUpdatedStaffEvent $event)
    {
        $staff = StaffMapping::initToModel($event->data);
        Staff::where('id', $staff['id'])->update($staff);
    }
}
