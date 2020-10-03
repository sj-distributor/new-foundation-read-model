<?php
namespace Wiltechs\Foundation\Dtos;

use Wiltechs\Foundation\Dtos\DtoInterface;
use Wiltechs\Foundation\Traits\FormatDateTrait;

class CnStaffInfoDto implements DtoInterface
{
    use FormatDateTrait;
    public $serialNumber;
    public $politicalStatus;
    public $maritalStatus;
    public $phoneNumber;
    public $hiredDate;
    public $contractStatus;
    public $workPlace;
    public $terminatedDate;
    public $seatNumber;
    public $identityCardNumber;
    public $nation;
    public $fertilityStatus;
    public $householdCategory;
    public $householdLocation;
    public $graduationSchool;
    public $major;
    public $education;
    public $bankName;
    public $bankNumber;
    public $email;
    public $fingerPrintNumber;
    public $internshipStartDate;
    public $internshipEndDate;
    public $address1;
    public $address2;
    public $currentAddress;
    public $emergencyContact;
    public $emergencyContactPhoneNumber;
    public $entranceGuardNumber;
    public $jobType;

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
        $this->identityCardNumber = @$data['identityCardNumber'];
        $this->nation = @$data['nation'];
        $this->fertilityStatus = @$data['fertilityStatus'];
        $this->householdCategory = @$data['householdCategory'];
        $this->householdLocation = @$data['householdLocation'];
        $this->graduationSchool = @$data['graduationSchool'];
        $this->major = @$data['major'];
        $this->education = @$data['education'];
        $this->bankName = @$data['bankName'];
        $this->bankNumber = @$data['bankNumber'];
        $this->email = @$data['email'];
        $this->fingerPrintNumber = @$data['fingerPrintNumber'];
        $this->internshipStartDate = @$data['internshipStartDate'];
        $this->internshipEndDate = @$data['internshipEndDate'];
        $this->address1 = @$data['address1'];
        $this->address2 = @$data['address2'];
        $this->currentAddress = @$data['currentAddress'];
        $this->emergencyContact = @$data['emergencyContact'];
        $this->emergencyContactPhoneNumber = @$data['emergencyContactPhoneNumber'];
        $this->entranceGuardNumber = @$data['entranceGuardNumber'];
        $this->jobType = @$data['jobType'];
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