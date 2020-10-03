<?php

namespace Wiltechs\Foundation\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $keyType = 'string';

    protected $guarded = [];

    public $timestamps = false;

    public $table = 'unit';

} 
