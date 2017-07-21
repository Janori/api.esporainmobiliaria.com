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
        	['name' => 'Luke Skywalker', 'username' => 'admin', 'email' => 'luke1@gmail.com', 'password' => 'secret'],
        	['name' => 'Luke Skywalker', 'username' => 'user2', 'email' => 'luke2@gmail.com', 'password' => 'secret'],
        	['name' => 'Luke Skywalker', 'username' => 'user3', 'email' => 'luke3@gmail.com', 'password' => 'secret'],
        	['name' => 'Luke Skywalker', 'username' => 'user4', 'email' => 'luke4@gmail.com', 'password' => 'secret'],
        );

        foreach($users as $user){
        	User::create($user);
        }
    }
}
