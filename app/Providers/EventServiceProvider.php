<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\FoundationInitdOrganisationEvent' => [
            'App\Listeners\FoundationInitOrganisationListener'
        ],
        'App\Events\FoundationInitPositionEvent' => [
            'App\Listeners\FoundationInitPositionListener'
        ],
        'App\Events\FoundationInitStaffEvent' => [
            'App\Listeners\FoundationInitStaffListener'
        ],
        'App\Events\FoundationAddedStaffEvent' => [
            'App\Listeners\FoundationAddedStaffListener'
        ],
        'App\Events\FoundationUpdatedStaffEvent' => [
            'App\Listeners\FoundationUpdatedStaffListener'
        ],
        'App\Events\FoundationAddedPositionEvent' => [
            'App\Listeners\FoundationAddedPositionListener'
        ],
        'App\Events\FoundationUpdatedPositionEvent' => [
            'App\Listeners\FoundationUpdatedPositionListener'
        ],
        'App\Events\FoundationDeletedPositionEvent' => [
            'App\Listeners\FoundationDeletedPositionListener'
        ],
        'App\Events\FoundationAddedUnitEvent' => [
            'App\Listeners\FoundationAddedUnitListener'
        ],
        'App\Events\FoundationUpdatedUnitEvent' => [
            'App\Listeners\FoundationUpdatedUnitListener'
        ],
        'App\Events\FoundationDeletedUnitEvent' => [
            'App\Listeners\FoundationDeletedUnitListener'
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
