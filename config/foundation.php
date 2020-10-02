<?php

return [

    // env

    'host' => env('QUEUE_HOST'),
    'user' => env('QUEUE_USER'),
    'password' => env('QUEUE_PASSWORD'),
    'port' => env('QUEUE_PORT'),
    'path' => env('QUEUE_PATH', '/'),
    'queue_name' => env('QUEUE_NAME'),
    'rabbitmq_queue_error' => env('QUEUE_ERROR'),
    
    'rabbitmq_queue_error' => 'pick_mistake_error',


   // exchange maps 


   'exchangeMaps' => [
        'NewFoundationInitialisedAllOrganisationStructuresEvent' => \App\Events\FoundationInitdOrganisationEvent::class,
        'NewFoundationInitialisedAllPositionsStructuresEvent' => \App\Events\FoundationInitPositionEvent::class,
        'NewFoundationInitialisedAllStaffsEvent' => \App\Events\FoundationInitStaffEvent::class,
        'StaffAddedEvent' => \App\Events\FoundationAddedStaffEvent::class,
        'StaffUpdatedEvent' => \App\Events\FoundationUpdatedStaffEvent::class,
        'PositionCreatedEvent' => \App\Events\FoundationAddedPositionEvent::class,
        'PositionUpdatedEvent' => \App\Events\FoundationUpdatedPositionEvent::class,
        'PositionDeletedEvent' => \App\Events\FoundationDeletedPositionEvent::class,
        'OrganisationStructureSimpleCreatedEvent' => \App\Events\FoundationAddedUnitEvent::class,
        'OrganisationStructureSimpleUpdatedEvent' => \App\Events\FoundationUpdatedUnitEvent::class,
        'OrganisationStructureDeletedEvent' => \App\Events\FoundationDeletedUnitEvent::class
   ],

    // table filed maps

    'staff' => [
        'id' => 'id',
        'organisation_structure_id' => 'organisation_structure_id',
        'user_id' => 'user_id',
        'username' => 'username',
        'residential_country' => 'residential_country',
        'brithday' => 'brithday',
        'name_cn' => 'name_cn',
        'name_en' => 'name_en',
        'cn_staff_info' => 'cn_staff_info',
        'us_staff_info' => 'us_staff_info',
        'staff_positions' => 'staff_positions',
        'gender' => 'gender'
    ],

    'unit' => [
        'id' => 'id',
        'name' => 'name',
        'leader_ids' => 'leader_ids',
        'type' => 'type',
        'type_desc' => 'type_desc',
        'children' => 'children',
        'is_active' => 'is_active',
        'parent_id' => 'parent_id',
        'positions' => 'positions',
        'country_code' => 'country_code'
    ],

    'position' => [
        'id' => 'id',
        'name' => 'name',
        'is_active' => 'is_active',
        'description' => 'description',
        'entity_id' => 'entity_id'
    ]
];