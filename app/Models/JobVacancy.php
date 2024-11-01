<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobVacancy extends Model
{
    use HasFactory;

  protected $guarded = ['id'];
  public $timestamps =  false;

   
    public function category()
    {
        return $this->belongsTo(JobCategory::class, 'job_category_id');
    }

  
    public function availablePositions()
    {
      
        return $this->hasMany(AvailablePosition::class); 
    }
}
