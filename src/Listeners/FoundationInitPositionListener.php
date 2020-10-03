<?php

namespace Wiltechs\Foundation\Listeners;

use App\Events\FoundationInitPositionEvent;
use App\Mappings\PositionMapping;
use Illuminate\Support\Facades\DB;
use App\Models\Position;

class FoundationInitPositionListener
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
     * @param  FoundationInitPositionEvent  $event
     * @return void
     */
    public function handle(FoundationInitPositionEvent $event)
    {
        try {
           
            DB::beginTransaction();

            DB::table('position')->truncate();
            
            foreach($event->data as $val) {
                Position::create(PositionMapping::initToModel($val));
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();

            // 抛出一个异常, 把任务返回错误的队列
            throw new \Exception($e->getMessage());
        }
    }
}
