<?php

namespace Wiltechs\Foundation\Listeners;

use Wiltechs\Foundation\Events\FoundationInitdOrganisationEvent;
use Wiltechs\Foundation\Mappings\UnitMapping;
use Wiltechs\Foundation\Models\Unit;
use Illuminate\Support\Facades\DB;
class FoundationInitOrganisationListener
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
     * @param  FoundationInitdOrganisationEvent  $event
     * @return void
     */
    public function handle(FoundationInitdOrganisationEvent $event)
    {
        try {
           
            DB::beginTransaction();
          
            $units = Unit::all();

            $units->each(function($unit) {
                $unit->delete();
            });
            
            foreach($event->data as $val) { 
                Unit::create(UnitMapping::initToModel($val));
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            // 抛出一个异常, 把任务返回错误的队列
            throw new \Exception($e->getMessage());
        }
    }
}
