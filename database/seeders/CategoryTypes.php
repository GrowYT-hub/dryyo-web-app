<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Types;

class CategoryTypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('name'=>'top wear'),
            array('name'=>'bottom wear'),
        );
        Category::insert($data);
        $types_data = array(
            array('name'=>'men'),
            array('name'=>'women'),
            array('name'=>'kid'),
            array('name'=>'home'),
        );
        Types::insert($types_data);
    }
}
