<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacistMedicine extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function pharmacist(){
        return $this->belongsTo(Pharmacist::class);
    }
}
