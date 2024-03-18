<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory,Notifiable;
    protected $guarded=[];
    public function pharmacist(){
        return $this->belongsTo(Pharmacist::class);
    }
    public function warehouse(){
        return $this->belongsTo(Warehouse::class);
    }
    public function medicines(){
        return $this->hasMany(OrderMedicine::class);
    }
}
