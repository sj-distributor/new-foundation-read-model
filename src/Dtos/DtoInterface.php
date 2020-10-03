<?php
namespace Wiltechs\Foundation\Dtos;

interface DtoInterface
{
    public function toArray(): Array;

    public function toJson(): String;
}