<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    public $fillable = [
        'column',
        'label',
        'visible',
        'type'
    ];
}
