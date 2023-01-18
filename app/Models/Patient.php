<?php

namespace App\Models;

use App\Models\Account;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;

    protected $guarded=[];

    protected $hidden = [
        'create_at',
        'updated_at',
        'account_id',
        'gender_id',


    ];


    public function  patieonAnalys(){
        return $this->hasMany(patieonAnalys::class);

    }

    public function  account(){
        return $this->hasMany(Account::class);
    }
}
