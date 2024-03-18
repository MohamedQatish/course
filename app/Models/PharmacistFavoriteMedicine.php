<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacistFavoriteMedicine extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function pharmacist(){
        return $this->belongsTo(Pharmacist::class);
    }
    
    public function medicine(){
        return $this->belongsTo(Medicine::class);
    }
}
