<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        'name' => 'John Doe',
        'email' => 'bobiankimani@gmail.com',
        'username' => 'testuser',
        'mobile_number'=> '0712345678',
        'country'=> 'Kenya',
        'city'=> 'Nairobi',
        'verified'=>1,
        'password' => bcrypt('testuser'),
        'remember_token' => str_random(10),
        ]);
        $this->call(UsersTableSeeder::class);
        $this->call(PartsTableSeeder::class);
        $this->call(RestaurantTableSeeder::class);
        
    }
}
