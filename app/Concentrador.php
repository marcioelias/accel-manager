<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Concentrador extends Model
{
    public $fillable = [
        'server_name',
        'ip_address',
        'port',
        'password',
        'active'
    ];

    public $table = 'concentradores';
}
