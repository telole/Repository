<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class regional extends Model
{
    //
    protected $guarded = ['id'];

    public function societies() {
        return $this->belongsTo(societies::class);
    }
}
