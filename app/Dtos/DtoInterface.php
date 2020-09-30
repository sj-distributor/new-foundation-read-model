<?php
namespace App\Dtos;

interface DtoInterface
{
    public function toArray(): Array;

    public function toJson(): String;
}