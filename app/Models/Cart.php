<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function types(){
        return $this->hasOne(Types::class,'id','type_id');
    }

    public function categories(){
        return $this->hasOne(Laundry::class,'id','categories_id');
    }

    public function subCategories(){
        return $this->hasOne(Cloths::class,'id','sub_categories_id');
    }

    public function orders(){
        return $this->hasOne(Order::class,'cart_id','id');
    }
}
