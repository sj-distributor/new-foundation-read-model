<?php
namespace App\Mappings;

use App\Dtos\OrganizateChild;
use App\Dtos\OrganizateChildDto;


class OrganizationMapping
{
    public static function initToModel($data)
    {
         return [
            "id" => $data['entityId'],
            "is_active" => isset($data['isActive']) ? $data['isActive'] : 0,
            "name" => $data['name'],
            "leader_ids" => implode('.', $data['leaderIds']),   // @type Array
            "parent_id" => $data['parentEntityId'],
            "type" => $data['type'],
            "type_desc" => $data['typeDesc'],
            "children" => self::getChildren($data['children']),   // @type JSON
            "positions" => json_encode($data['positions']),  // @type JSON
            "country_code" => $data['countryCode']
         ];
    }

    public static function getChildren($children)
    {
        $array = array_map(function($item){
            return (new OrganizateChildDto($item))->toArray();
        }, $children);

        return json_encode($array);
    }
}