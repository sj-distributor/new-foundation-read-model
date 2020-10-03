<?php
namespace Wiltechs\Foundation\Dtos;

use Wiltechs\Foundation\Dtos\DtoInterface;
use Wiltechs\Foundation\Dtos\BooleanToIntTrait;

class UnitPositionDto implements DtoInterface
{
    use BooleanToIntTrait;

    public $id;
    public $entityId;
    public $name;
    public $isActive;
	
    public function __construct(array $data)
    {
       $this->id = strtoupper(@$data['id']);

       $this->entityId = strtoupper($data['entityId']);

       $this->name = $data['name'];

       $this->isActive = self::booleanToInt(@$data['isActive']);
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