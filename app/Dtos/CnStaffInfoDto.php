<?php
namespace App\Dtos;

use App\Dto\DtoInterface;

class CnStaffInfoDto implements DtoInterface
{
    public $serialNumber;
    public $politicalStatus;
    public $maritalStatus;
    public $phoneNumber;
    public $hiredDate;
    public $contractStatus;
    public $workPlace;
    public $terminatedDate;
    public $seatNumber;

    public function __construct(array $data)
    {
        $this->serialNumber = $data['serialNumber'];
        $this->politicalStatus = $data['serialNumber'];
        $this->maritalStatus = $data['serialNumber'];
        $this->phoneNumber = $data['serialNumber'];
        $this->hiredDate = $data['serialNumber'];
        $this->contractStatus = $data['serialNumber'];
        $this->workPlace = $data['serialNumber'];
        $this->terminatedDate = $data['serialNumber'];
        $this->seatNumber = $data['serialNumber'];
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