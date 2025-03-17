<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'     => 'ziyad',
            'email'    => 'ziyad19@yahoo.com',
            'password' => Hash::make('13131313'),
        ]);
        
        //$this->call(TestSeeder::class);
    }
}
