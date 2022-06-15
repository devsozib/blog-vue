<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker  = Faker::create();
        foreach(range(1,20 ) as $index){
            Post::create([
                "user_id"=> rand(1,20),
                "category_id"=> rand(1,5),
                "title"=>$faker->sentence,
                "content"=>$faker->paragraph,
                "thumbnail"=>$faker->imageUrl,
                "status"=> $this->getRandomStatus(),



            ]);
        }
    }

    public function getRandomStatus(){
        $statues = array("draft","published");
       return $statues[array_rand($statues)];
    }
}
