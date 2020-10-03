<?php

namespace Wiltechs\Foundation\Mappings;

use Wiltechs\Foundation\Dtos\CnStaffInfoDto;
use Wiltechs\Foundation\Dtos\UsStaffInfoDto;
use Illuminate\Support\Carbon;
use Wiltechs\Foundation\Dtos\BooleanToIntTrait;
use Wiltechs\Foundation\Dtos\StaffPositionDto;

class StaffMapping 
{
    use BooleanToIntTrait;

    public static function initToModel($data)
    {
       return [
            config('foundation.staff.organisation_structure_id') => strtoupper($data['organisationStructureId']),
            config('foundation.staff.id')  => strtoupper($data['id']),
            config('foundation.staff.residential_country') => $data['residentialCountry'],
            config('foundation.staff.gender') => isset($data['gender']) ? self::booleanToInt($data['gender']) : 0,
            config('foundation.staff.brithday')  => (new Carbon(@$data['doB']))->format('Y-m-d'),
            config('foundation.staff.name_en')  => @$data['nameEn'],
            config('foundation.staff.name_cn')  => @$data['nameCn'],
            config('foundation.staff.user_id')  => strtoupper(@$data['userID']),
            config('foundation.staff.username')  => @$data['userName'],
            config('foundation.staff.staff_positions')  => isset($data['staffPositions']) ? 
                                                             self::getStaffPositions($data['staffPositions']) :
                                                             '[]',
            config('foundation.staff.us_staff_info') => isset($data['usStaffInfo']) ?
                                                        (new UsStaffInfoDto($data['usStaffInfo']))->toJson(): 
                                                        '[]',
            config('foundation.staff.cn_staff_info') => isset($data['cnStaffInfo']) ? 
                                                        (new CnStaffInfoDto($data['cnStaffInfo']))->toJson():  
                                                        '[]',
       ];
    }

    public static function getStaffPositions($staffOptions)
    {

        $result =  array_map(function($val) {
            return (new StaffPositionDto($val))->toArray();
        }, $staffOptions);

        return json_encode($result);
    }
}