<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $guarded = [];
    protected $casts=[
        'phone' => 'array'
    ];

}
