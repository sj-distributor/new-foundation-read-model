<?php
namespace App\Mappings;

use App\Dtos\OrganizateChild;
use App\Dtos\OrganizateChildDto;


class UnitMapping
{
    public static function initToModel($data)
    {
         return [
            "id" => $data['entityId'],
            "is_active" => isset($data['isActive']) ? $data['isActive'] : 0,
            "name" => $data['name'],
            "leader_ids" => implode('.', $data['leaderIds']),   // @type Array
            "parent_id" => @$data['parentEntityId'],
            "type" => $data['type'],
            "type_desc" => @$data['typeDesc'],
            "children" => isset($data['children']) ? self::getChildren($data['children']) : null,   // @type JSON
            "positions" => isset($data['positions']) ? json_encode($data['positions']): null,  // @type JSON
            "country_code" => $data['countryCode']
         ];
    }

    public static function updateToModel($data)
    {
        $output = [
            "id" => $data['entityId'],
            "is_active" => isset($data['isActive']) ? $data['isActive'] : 0,
            "name" => $data['name'],
            "leader_ids" => implode('.', $data['leaderIds']),   // @type Array
            "parent_id" => @$data['parentEntityId'],
            "type" => $data['type'],
            "type_desc" => @$data['typeDesc'],
            "country_code" => $data['countryCode']
         ];
    
        if (isset($data['children'])) {
            $output["children"] = isset($data['children']) ? self::getChildren($data['children']) : null; 
        }

        if (isset($data['positions'])) {
            $output["positions"] = isset($data['positions']) ? json_encode($data['positions']): null; 
        }

        return $output;
    }

    public static function getChildren($children)
    {
        $array = array_map(function($item){
            return (new OrganizateChildDto($item))->toArray();
        }, $children);

        return json_encode($array);
    }
}