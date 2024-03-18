<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Pharmacist extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable=['name','phone_number','password'];
    protected $guard='pharmacist';

    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function medicines(){
        return $this->hasMany(PharmacistMedicine::class);
    }
    public function favoriteMedicines(){
        return $this->hasMany(PharmacistFavoriteMedicine::class);
    }
}
