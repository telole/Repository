<?php

namespace App\Models;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Society extends Authenticatable
{

    use HasApiTokens, HasFactory;
    public $timestamps =  false;

    // protected $fillable = [
    //     'id_card_number', 'password', 'name', 'born_date', 
    //     'gender', 'address', 'regional_id'
    // ];

    protected $guarded = ['id'];
    protected $hidden = ['id_card_number', 'password', 'login_tokens', 'id'];

   
    public function regional()
    {
        return $this->belongsTo(Regional::class);
    }

    
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
