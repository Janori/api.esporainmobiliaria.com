<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
        	['name' => 'Luke Skywalker', 'email' => 'luke1@gmail.com', 'password' => 'secret'],
        	['name' => 'Luke Skywalker', 'email' => 'luke2@gmail.com', 'password' => 'secret'],
        	['name' => 'Luke Skywalker', 'email' => 'luke3@gmail.com', 'password' => 'secret'],
        	['name' => 'Luke Skywalker', 'email' => 'luke4@gmail.com', 'password' => 'secret'],
        );

        foreach($users as $user){
        	User::create($user);
        }
    }
}
