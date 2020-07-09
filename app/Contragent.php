<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contragent extends Model
{
    protected $table = 'contragents';

    protected $fillable = [
        	'first_name',
            'second_name',
            'three_name',
            'phone',
            'email',
            'company',
            'region',
    ];
}
