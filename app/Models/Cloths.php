<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cloths extends Model
{
    use HasFactory;

    public function categories(){
        return $this->hasOne(Laundry::class,'id','category_id')->with('types');
    }
}
