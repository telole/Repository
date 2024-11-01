<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    //

    protected $table = 'job_apply_positions';

 

    protected $guarded = ['id'];
    public $timestamps = false;


    public function societies() {
        return $this->belongsTo(societies::class);


    }

    public function job_apply_societies() {
        return $this->belongsTo(job_apply_societies::class);
    }

    public function avaible_position() {
        return $this->belongsTo(AvailablePosition::class);
    }

    public function job_vacancies() {
        return $this->belongsTo(job_vacancies::class);
    }
}
