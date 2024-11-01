<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applypos extends Model
{
    protected $table = 'job_apply_positions'; 
    protected $guarded = ['id'];
    public $timestamps = false;

   
    public function society() {
        return $this->belongsTo(Society::class);
    }

    public function jobVacancy() {
        return $this->belongsTo(JobVacancy::class);
    }
}
