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
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
        		'nama_user' => 'Test',
        		'email' => 'test@philips.com',
        		'password' => hash('md5', 'test@philips.com'),
        	]);
    }
}
