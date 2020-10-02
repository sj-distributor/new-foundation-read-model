<?php

return [
    
    'rabbitmq_queue_error' => 'pick_mistake_error',
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
        'username' => 'username',
        'type' => 'type',
        'type_desc' => 'type_desc',
        'name_cn' => 'name_cn',
        'name_en' => 'name_en',
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