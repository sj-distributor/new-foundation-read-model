<?php

namespace App\Listeners;

use App\Events\FoundationInitStaffEvent;
use Illuminate\Support\Facades\DB;
use App\Models\Staff;
use App\Mappings\StaffMapping;
use Exception;

class FoundationInitStaffListener
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
     * @param  FoundationInitStaffEvent  $event
     * @return void
     */
    public function handle(FoundationInitStaffEvent $event)
    {
        try {
            DB::beginTransaction();

            DB::table('staff')->truncate();
            
            foreach($event->data as $val) {
                Staff::create(StaffMapping::initToModel($val));
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();

            // 抛出一个异常, 把任务返回错误的队列
            throw new Exception($e->getMessage());
        }
    }
}
