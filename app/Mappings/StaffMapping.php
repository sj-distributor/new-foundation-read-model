<?php

namespace App\Mappings;

use App\Dtos\CnStaffInfoDto;
use App\Dtos\UsStaffInfoDto;
use Illuminate\Support\Carbon;

class StaffMapping 
{
    public static function initToModel($data)
    {
       return [
            "organisation_structure_id"  => $data['organisationStructureId'],
            "id"  => $data['id'],
            "residential_country" => $data['residentialCountry'],
            "gender" => isset($data['gender']) ? $data['gender'] : 0,
            "brithday"  => (new Carbon(@$data['doB']))->format('Y-m-d'),
            "name_en"  => @$data['nameEn'],
            "name_cn"  => @$data['nameCn'],
            "user_id"  => @$data['userID'],
            "username"  => @$data['userName'],
            "staff_positions"  => json_encode(@$data['staffPositions']),
            "us_staff_info" => isset($data['usStaffInfo']) ? (new UsStaffInfoDto($data['usStaffInfo']))->toJson():  null,
            "cn_staff_info" => isset($data['cnStaffInfo']) ? (new CnStaffInfoDto($data['cnStaffInfo']))->toJson():  null,
       ];
    }
}