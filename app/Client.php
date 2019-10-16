<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = array();

    protected $fillable = [
        'name', 'address', 'phone',
    ];
    protected  $casts =[
        'phone'=>'array',
    ];
}
