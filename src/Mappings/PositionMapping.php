<?php

namespace Wiltechs\Foundation\Mappings;

class PositionMapping 
{
    public static function initToModel($data)
    {
       return [
            config('foundation.position.id')  => $data['id'],
            config('foundation.position.entity_id') => $data['entityId'],
            config('foundation.position.name') => $data['name'],
            config('foundation.position.is_active')  => isset($data['isActive']) ? $data['isActive'] : 0,
            config('foundation.position.description') => @$data['description']
       ];
    }
}