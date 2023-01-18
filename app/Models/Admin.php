<?php

namespace App\Models;

use App\Models\Section;

use App\Models\adminTupe;
use App\Models\AdminSetting;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory , HasApiTokens;

    protected $guarded=[];

    // protected  $guard='admin';

    protected $hidden = [
        'password',
    ];


    public function adminTupe(){
        return $this->hasMany(adminTupe::class);
    }

    // public function scopeAdminSection($q){
    //     return $q->where('role',Section::ADMIN);
    // }
}
