<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Str;
use Hash;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('users')->insert([
    		'name' => 'Ali Nawaz',
    		'email' => 'alinawaz@gmail.com',
    		'password' => Hash::make('12345678'),
    	]);
    }
}
