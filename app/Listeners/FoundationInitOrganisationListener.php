<?php

namespace App\Listeners;

use App\Events\FoundationInitdOrganisationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
        //
    }
}
