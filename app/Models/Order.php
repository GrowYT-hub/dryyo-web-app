<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function carts(){
        return $this->hasOne(Cart::class,'id','cart_id');
    }

    public function services(){
        return $this->hasOne(Services::class,'id','request_id')->with('user');
    }
}
