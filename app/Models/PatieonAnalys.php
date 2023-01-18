<?php

namespace App\Models;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PatieonAnalys extends Model
{
    use HasFactory;

    protected $guarded=[];

    protected $hidden = [
        'created_at',
        'patient_id',
        'updated_at',
        'doctor_id',
        'lab_id',
        'company_id',
        'section_id',
        'analyz_id',
        'send_method_id',
        'payment_method_id',


    ];



    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }

}
