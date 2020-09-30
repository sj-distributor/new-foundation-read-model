<?php

namespace App\Mappings;

use App\Dto\CnStaffInfoDto;
use App\Dtos\UsStaffInfoDto;

class StaffMapping 
{
    public static function initToModel($data)
    {

       return [
            "organisation_structure_id"  => $data['organisationStructureId'],
            "id"  => $data['id'],
            "residential_country" => $data['organisationStructureId'],
            "gender" => $data['gender'],
            "brithday"  => $data['doB'],
            "name_en"  => $data['nameEn'],
            "name_cn"  => $data['nameCn'],
            "us_staff_info" => isset($data['usStaffInfo']) ? (new UsStaffInfoDto($data['usStaffInfo']))->toJson():  null,
            "cn_staff_info" => isset($data['cnStaffInfo']) ? (new CnStaffInfoDto($data['cnStaffInfo']))->toJson():  null,
       ];
    }
}