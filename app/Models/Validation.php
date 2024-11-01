<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    protected $casts = [
        'status' => 'string',
    ];
}
