<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Warehouse extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable=['name','email','password'];
    protected $guard='warehouse';
    protected $keyType = 'int'; // Ensure the key type is set to 'int'
    protected $casts = ['id' => 'int']; // Cast the 'id' attribute to an integer

    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function medicines(){
        return $this->hasMany(Medicine::class);
    }
    
}
