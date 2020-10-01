<?php

namespace App\Listeners;

use App\Events\FoundationInitdOrganisationEvent;
use App\Mappings\OrganizationMapping;
use App\Models\Unit;
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
          
            DB::table('unit')->truncate();
            
            foreach($event->data as $val) { 
                Unit::create(OrganizationMapping::initToModel($val));
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            // 抛出一个异常, 把任务返回错误的队列
            throw new \Exception($e->getMessage());
        }
    }
}
