<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    
    protected $table = 'prescription';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['prescription_date','patient_id','prescription_description','prescription_price','prescription_status'];
    
    public function payment(){
        return $this->hasmany('Payment');
    }
    
    public function patient(){
        return $this->belongsTo(Patient::class, 'patient_id')->withDefault();
    }
}
