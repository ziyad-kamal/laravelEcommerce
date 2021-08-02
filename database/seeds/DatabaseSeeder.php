<?php


use Illuminate\Database\Seeder;

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
            'email'    => 'ziyad199523@yahoo.com',
            'password' => Hash::make('Zi121212'),
        ]);
        

        //$this->call(TestSeeder::class);
    }
}
