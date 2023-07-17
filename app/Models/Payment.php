<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    
    protected $table = 'payment';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['prescription_id','payment_type','payment_amount'];
    
    public function payment(){
        return $this->belongsTo(Payment::class, 'prescription_id')->withDefault();
    }
}
