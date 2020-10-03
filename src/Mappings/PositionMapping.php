<?php

namespace Wiltechs\Foundation\Mappings;

use Wiltechs\Foundation\Dtos\BooleanToIntTrait;

class PositionMapping 
{
    use BooleanToIntTrait;
    public static function initToModel($data)
    {
       return [
            config('foundation.position.id')  => $data['id'],
            config('foundation.position.entity_id') => $data['entityId'],
            config('foundation.position.name') => $data['name'],
            config('foundation.position.is_active')  => isset($data['isActive']) ?  self::booleanToInt($data['isActive']) : 0,
            config('foundation.position.description') => @$data['description']
       ];
    }
}