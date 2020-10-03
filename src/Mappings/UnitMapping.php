<?php
namespace Wiltechs\Foundation\Mappings;

use Wiltechs\Foundation\Dtos\BooleanToIntTrait;
use Wiltechs\Foundation\Dtos\OrganizateChild;
use Wiltechs\Foundation\Dtos\OrganizateChildDto;
use Wiltechs\Foundation\Dtos\UnitPositionDto;


class UnitMapping
{
    use BooleanToIntTrait;

    public static function initToModel($data)
    {
         return [
            config('foundation.unit.id') => strtoupper($data['entityId']),
            config('foundation.unit.is_active')  => isset($data['isActive']) ? self::booleanToInt($data['isActive']) : 0,
            config('foundation.unit.name') => $data['name'],
            config('foundation.unit.leader_ids')  => strtoupper(implode('.', $data['leaderIds'])),   // @type Array
            config('foundation.unit.parent_id')  => strtoupper(@$data['parentEntityId']),
            config('foundation.unit.type')  => $data['type'],
            config('foundation.unit.type_desc')  => @$data['typeDesc'],
            config('foundation.unit.children')  => isset($data['children']) ? self::getChildren($data['children']) : null,   // @type JSON
            config('foundation.unit.positions')  => isset($data['positions']) ? 
                                                    self::getPosition($data['positions']): 
                                                    '[]',  // @type JSON
            config('foundation.unit.country_code')  => $data['countryCode']
         ];
    }

    public static function updateToModel($data)
    {
        $output = [
            config('foundation.unit.id') => strtoupper($data['entityId']),
            config('foundation.unit.is_active') => isset($data['isActive']) ? self::booleanToInt($data['isActive']) : 0,
            config('foundation.unit.name') => $data['name'],
            config('foundation.unit.leader_ids') => strtoupper(implode('.', $data['leaderIds'])),   // @type Array
            config('foundation.unit.parent_id') => strtoupper(@$data['parentEntityId']),
            config('foundation.unit.type') => $data['type'],
            config('foundation.unit.type_desc') => @$data['typeDesc'],
            config('foundation.unit.country_code') => $data['countryCode']
         ];
    
        if (isset($data['children'])) {
            $output[config('foundation.unit.children')] = isset($data['children']) ? self::getChildren($data['children']) : null; 
        }

        if (isset($data['positions'])) {
            $output[config('foundation.unit.positions')] = isset($data['positions']) ? 
                                                             self::getPosition($data['positions']):
                                                            '[]'; 
        }

        return $output;
    }


    public static function getPosition($positions)
    {
        $resutl = array_map(function($position) {
            return (new UnitPositionDto($position))->toArray();
        }, $positions);

        return json_encode($resutl);
    }

    public static function getChildren($children)
    {
        $array = array_map(function($item){
            return (new OrganizateChildDto($item))->toArray();
        }, $children);

        return json_encode($array);
    }
}