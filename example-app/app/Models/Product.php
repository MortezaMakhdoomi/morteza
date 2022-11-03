<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\product as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Product extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;


    protected $fillable = [
        'name',
        'price',
        'type',
        'discount',
        'food_party',
        
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}