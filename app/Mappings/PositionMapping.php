<?php

namespace App\Mappings;

class PositionMapping 
{
    public static function initToModel($data)
    {
       return [
            "id"  => $data['id'],
            "entity_id" => $data['entityId'],
            "name" => $data['name'],
            "is_active"  => isset($data['isActive']) ? $data['isActive'] : 0,
       ];
    }
}