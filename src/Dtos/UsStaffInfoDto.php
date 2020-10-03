<?php
namespace Wiltechs\Foundation\Dtos;

use Wiltechs\Foundation\Dtos\DtoInterface;
use Wiltechs\Foundation\Traits\FormatDateTrait;
class UsStaffInfoDto implements DtoInterface
{
        use FormatDateTrait;
              
        public $payrollName;
        public $locationID;
        public $ssn;
        public $language;
        public $wechatName;
        public $wechatAccount;
        public $backToWarehouse;
        public $address;
        public $city;
        public $badge;
        public $territoryCode;
        public $postalCode;
        public $personalMobile;
        public $workPhone;
        public $emergencyContact;
        public $emergencyTel;
        public $comment;
        public $w4MaritalStatus;
        public $w4Excomption;
        public $w4MaritalState;
        public $w4MaritalStateExcomption;
        public $driverNumber;
        public $hiredDate;
        public $reHiredDate;
        public $terminatedDate;
        public $terminatedComment;
        public $deletedDate;
        public $status;
        public $locationDescription;
        public $positionStatus;


        //
        public $locationName;
        public $driverCode;
        public $derverExp;
        public $companyName;
        public $companyId;

    public function __construct(array $data)
    {
        $this->payrollName = @$data['payrollName'];
        $this->locationID = strtoupper(@$data['locationID']);
        $this->ssn = @$data['ssn'];
        $this->language = @$data['language'];
        $this->wechatName = @$data['wechatName'];
        $this->wechatAccount = @$data['wechatAccount'];
        $this->backToWarehouse = @$data['backToWarehouse'];
        $this->address = @$data['address'];
        $this->city = @$data['city'];
        $this->badge = @$data['badge'];
        $this->territoryCode = @$data['territoryCode'];
        $this->postalCode = @$data['postalCode'];
        $this->personalMobile = @$data['personalMobile'];
        $this->workPhone = @$data['workPhone'];
        $this->emergencyContact = @$data['emergencyContact'];
        $this->emergencyTel = @$data['emergencyTel'];
        $this->comment = @$data['comment'];
        $this->w4MaritalStatus = @$data['w4MaritalStatus'];
        $this->w4Excomption = @$data['w4Excomption'];
        $this->w4MaritalState = @$data['w4MaritalState'];
        $this->w4MaritalStateExcomption = @$data['w4MaritalStateExcomption'];
        $this->driverNumber = @$data['driverNumber'];
        $this->hiredDate = $this->formatDate(@$data['hiredDate']);
        $this->reHiredDate =  $this->formatDate(@$data['reHiredDate']);
        $this->terminatedDate =  $this->formatDate(@$data['terminatedDate']);
        $this->terminatedComment = @$data['terminatedComment'];
        $this->deletedDate = @$data['deletedDate'];
        $this->status = @$data['status'];
        $this->locationDescription = @$data['locationDescription'];
        $this->positionStatus= @$data['positionStatus'];
        $this->locationName = @$data['locationName'];;
        $this->driverCode = @$data['driverCode'];;
        $this->derverExp = @$data['derverExp'];;
        $this->companyName = @$data['companyName'];;
        $this->companyId = strtoupper(@$data['companyId']);
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