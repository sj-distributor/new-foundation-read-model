<?php
namespace Wiltechs\Foundation\Dtos;

use Wiltechs\Foundation\Dtos\DtoInterface;

class OrganizateChildDto implements DtoInterface
{
    public $name;
    public $leaderIds;
    public $id;
    public $type;
    public $children;
	
    public function __construct(array $data)
    {
      // dd($data);
       $this->name = $data['name'];

       $this->leaderIds = array_map(function($val) {
            return strtoupper($val);  
       }, $data['leaderIds']);

       $this->id = strtoupper($data['entityId']);

       $this->type = $data['type'];

       $this->children = $this->getChild($data['children']);
    }


    public function getChild($data)
    {
        return array_map(function($item) {
            return [
                'name' => $item['name'],
                'leaderIds' => array_map(function($val) {
                                return strtoupper($val);  
                             }, $item['leaderIds']),
                'id' => strtoupper($item['entityId']),
                'type' => $item['type'],
                'children' => count($item['children']) ? ($this->getChild($item['children'])) : []
            ];
        }, $data);
        
    }

    public function toArray(): Array
    {
        return get_object_vars($this);
    }

    public function toJson(): String
    {
        return json_encode($this->toArray());
    }
}