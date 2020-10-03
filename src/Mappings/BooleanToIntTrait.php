<?php
namespace Wiltechs\Foundation\Dtos;

use Illuminate\Support\Carbon;

Trait BooleanToIntTrait 
{
    public static function booleanToInt($data)
    {
       if (filter_var($data, FILTER_VALIDATE_INT)) {
           return $data;
       }
       
       return $data ? ($data === true ? 1 : 0): 0;
    }
}