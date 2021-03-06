<?php

namespace Wiltechs\Foundation\Listeners;

use Wiltechs\Foundation\Events\FoundationInitPositionEvent;
use Wiltechs\Foundation\Mappings\PositionMapping;
use Illuminate\Support\Facades\DB;
use Wiltechs\Foundation\Models\Position;

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

            $options = Position::all();

            $options->each(function($option) {
                $option->delete();
            });
            
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
