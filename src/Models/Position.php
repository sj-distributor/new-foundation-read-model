<?php

namespace Wiltechs\Foundation\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $keyType = 'string';

    protected $guarded = [];

    public $timestamps = false;

    public $table = 'position';

} 
