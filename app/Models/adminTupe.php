<?php

namespace App\Models;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class adminTupe extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function admin(){
        return $this->belongsTo(Admin::class);
    }
}
