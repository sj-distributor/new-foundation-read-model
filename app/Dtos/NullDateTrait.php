<?php
namespace App\Dtos;

use Illuminate\Support\Carbon;

Trait NullDateTrait 
{
    public function formatDate($date)
    {
       return $date ? (new Carbon($date))->format('Y-m-d'): null;
    }
}