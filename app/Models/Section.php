<?php

namespace App\Models;

use App\Models\Analyz;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;

    protected $guarded=[];

    public const ADMIN=1;
    public const ACCOUNT=2;


    public function analyz(){
        return $this->hasMany(Analyz::class);
    }

    // public function scopeAdminSection($q){
    //     return $q->where('section_id',null)->where('account_id',null);
    // }

}
