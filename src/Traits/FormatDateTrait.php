<?php
namespace Wiltechs\Foundation\Traits;

use Illuminate\Support\Carbon;

Trait FormatDateTrait 
{
    public function formatDate($date)
    {
       return $date ? (new Carbon($date))->format('Y-m-d'): null;
    }
}