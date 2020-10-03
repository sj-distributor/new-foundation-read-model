<?php
namespace Wiltechs\Foundation\Dtos;

use Wiltechs\Foundation\Dtos\DtoInterface;
use Wiltechs\Foundation\Traits\FormatDateTrait;

class StaffPositionItemDto implements DtoInterface
{
    use FormatDateTrait;
    public $organisationStructureId;
    public $type;
    public $entityId;
    public $positionId;
    public $startDate;
    public $endDate;
    public $hiredDate;
    public $terminatedDate;
    public $status;
	
    public function __construct(array $data)
    {
       
       $this->organisationStructureId = strtoupper(@$data['organisationStructureId']);
       $this->type = @$data['type'];
       $this->entityId = strtoupper(@$data['entityId']);
       $this->positionId = strtoupper(@$data['positionId']);
       $this->startDate = $this->formatDate(@$data['startDate']);
       $this->endDate = $this->formatDate(@$data['endDate']);
       $this->terminatedDate = $this->formatDate(@$data['terminatedDate']);
       $this->hiredDate = $this->formatDate(@$data['hiredDate']);
       $this->status = @$data['status'];
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