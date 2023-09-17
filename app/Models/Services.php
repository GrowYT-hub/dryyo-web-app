<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    public function user(){
        return $this->hasOne(User::class,'id', 'user_id');
    }

    public function assign(){
        return $this->hasOne(User::class,'id', 'assigned_id');
    }

    public function carts(){
        return $this->hasMany(Cart::class,'request_id','id')->with(['orders','types','categories','subCategories']);
    }
}
