<?php
namespace App\Dtos;

use App\Dtos\DtoInterface;

class CnStaffInfoDto implements DtoInterface
{
    use NullDateTrait;
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
        $this->serialNumber = @$data['serialNumber'];
        $this->politicalStatus = @$data['politicalStatus'];
        $this->maritalStatus = @$data['maritalStatus'];
        $this->phoneNumber = @$data['phoneNumber'];
        $this->hiredDate = $this->formatDate(@$data['hiredDate']);
        $this->contractStatus = @$data['contractStatus'];
        $this->workPlace = @$data['workPlace'];
        $this->terminatedDate = $this->formatDate(@$data['terminatedDate']);
        $this->seatNumber = @$data['seatNumber'];
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