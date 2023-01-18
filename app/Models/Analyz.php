<?php

namespace App\Models;

use App\Models\Section;
use App\Models\TestUnit;
use App\Models\TestMethod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Analyz extends Model
{
    use HasFactory;

    protected $table = 'analyzs';

    protected $guarded = [];


    public function antibiotic()
    {
        return $this->hasMany(Antibiotic::class,'analyz_id');
    }

    public function TestUnit()
    {
        return $this->belongsTo(TestUnit::class);
    }

    public function TestMethod()
    {
        return $this->belongsTo(TestMethod::class);
    }

    public function Section(){
        return $this->belongsTo(Section::class);
    }

    public function classReport(): Attribute
    {
        return new Attribute(
            get: fn ($value) => json_decode($value),
            set: fn ($value) => json_encode($value),
        );
    }
    public function scopeAdminSection($q){
        return $q->select('id','test_print_name as name')->where('section_id',null)->where('account_id',null);
    }
    public function scopeAdminAnalys($q,$section_id){
        return $q->select('id','test_print_name as name')->where('account_id',null)->where('section_id',$section_id);
    }
}
