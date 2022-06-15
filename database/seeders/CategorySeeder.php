<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker  = Faker::create();
        foreach(range(1,5 ) as $index){
            $category = $faker->unique()->name;
            Category::create([


            "name"=>$category,
            "slug"=>$faker->slug,
            "status"=>rand(0,1)

            ]);
        }
    }
}
