<?php

use App\Models\Category;

use App\Models\Tests;
use Faker\Factory;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker  = Factory::create();
        
            for ($i=0; $i <= 5 ; $i++) { 
                $tests=Tests::create([
                    'price'=>$faker->randomFloat(2,400,5000),
                    'name'=> 'computers ' . $i,
                    'photo'=>'https://via.placeholder.com/150'
                ]);
            }
        

        //$tags=Tag::inRondomOrder()->take(3)->pluck('id')->toArray();
        //$tests->tags->attach();
    }
}
