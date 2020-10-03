<?php

namespace Wiltechs\Foundation\Listeners;

use App\Events\FoundationUpdatedStaffEvent;
use App\Mappings\StaffMapping;
use App\Models\Staff;

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
