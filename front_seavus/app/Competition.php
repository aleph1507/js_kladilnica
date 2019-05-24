<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $fillable = [
        'footballdata_id', 'area_id',
        'name', 'code', 'emblemUrl'
    ];
}
