<?php
namespace App\Dtos;

use App\Dto\DtoInterface;

class UsStaffInfoDto implements DtoInterface
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
        $this->payrollName = $data['payrollName'],
        $this->locationID = $data['payrollName'],
        $this->ssn = $data['payrollName'],
        $this->language = $data['payrollName'],
        $this->wechatName = $data['payrollName'],
        $this->wechatAccount = $data['payrollName'],
        $this->backToWarehouse = $data['payrollName'],
        $this->address = $data['payrollName'],
        $this->city = $data['payrollName'],
        $this->badge = $data['payrollName'],
        $this->territoryCode = $data['payrollName'],
        $this->postalCode = $data['payrollName'],
        $this->personalMobile = $data['payrollName'],
        $this->workPhone = $data['payrollName'],
        $this->emergencyContact = $data['payrollName'],
        $this->emergencyTel = $data['payrollName'],
        $this->comment = $data['payrollName'],
        $this->w4MaritalStatus = $data['payrollName'],
        $this->w4Excomption = $data['payrollName'],
        $this->w4MaritalState = $data['payrollName'],
        $this->w4MaritalStateExcomption = $data['payrollName'],
        $this->driverNumber = $data['payrollName'],
        $this->hiredDate = $data['payrollName'],
        $this->reHiredDate = $data['payrollName'],
        $this->terminatedDate = $data['payrollName'],
        $this->terminatedComment = $data['payrollName'],
        $this->deletedDate = $data['payrollName'],
        $this->status" = $data['payrollName'],
        $this->locationDescription" = $data['payrollName'],
        $this->positionStatus" = $data['payrollName']
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