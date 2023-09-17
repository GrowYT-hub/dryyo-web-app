<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laundry extends Model
{
    use HasFactory;

    public function types(){
        return $this->hasOne(Types::class,'id','type_id');
    }

    public function subCategories(){
        return $this->hasMany(Cloths::class,'category_id','id');
    }
}
