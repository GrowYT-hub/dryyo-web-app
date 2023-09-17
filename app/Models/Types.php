<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Types extends Model
{
    use HasFactory;

    public function categories(){
        return $this->hasMany(Laundry::class,'type_id', 'id')->with('subCategories');
    }
}
