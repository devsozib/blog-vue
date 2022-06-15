<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->defaultUser();
        $faker  = Faker::create();
        foreach(range(1,20 ) as $index){
            User::create([
                "name"=> $faker->name,
                "email"=>$faker->unique()->email,
                "password"=>bcrypt($faker->password),


            ]);
        }

    }

    public function defaultUser(){
        User::create([
            "name"=>"Admin",
            "email"=>"admin@example.com",
            "password"=>bcrypt(123456)
        ]);
    }
}
