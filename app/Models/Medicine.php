<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function warehouse(){
        return $this->belongsTo(Warehouse::class);
    }
    public function favoriteMedicines(){
        return $this->hasMany(PharmacistFavoriteMedicine::class);
    }
    public function category(){
        return $this->belongsTo(MedicineCategory::class, 'category_id');
    }
}
