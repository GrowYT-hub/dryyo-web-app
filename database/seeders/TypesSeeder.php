<?php

namespace Database\Seeders;

use App\Models\Types;
use Illuminate\Database\Seeder;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typesData = [
            ['name' => 'Men`s'],
            ['name' => 'Women`s'],
            ['name' => 'Children'],
            ['name' => 'Home Accessories'],
        ];
        foreach ($typesData as $types) {
            Types::create($types);
        }

    }
}
