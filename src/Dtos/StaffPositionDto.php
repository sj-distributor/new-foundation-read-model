<?php
namespace Wiltechs\Foundation\Dtos;

use Wiltechs\Foundation\Dtos\DtoInterface;
use Wiltechs\Foundation\Dtos\StaffPositionItemDto;

class StaffPositionDto implements DtoInterface
{
    public $id;
    public $isMajor;
    public $positions;
    public $record;
	
    public function __construct(array $data)
    {
      
       $this->id = strtoupper($data['id']);

       $this->isMajor = isset($data['isMajor']) ? $data['isMajor'] : false;

       $this->record = $data['record'];


       $this->positions = array_map(function ($val) {
           return (new StaffPositionItemDto($val))->toArray();
       }, $data['positions']);
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