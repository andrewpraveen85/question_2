<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    
    protected $table = 'patient';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['patient_nic','patient_name','patient_dob','patient_tell','patient_notes','patient_status','patient_photo'];
    public function prescription(){
        return $this->hasmany('Prescription');
    }
}
