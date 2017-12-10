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
        	['name' => 'Administrador', 'first_surname' => 'Espora',  'username' => 'admin', 'kind' => 'a', 'email' => 'admin@esporainmobiliaria.com', 'password' => '4j8vKqBKx7ZGZuvZ'],
        );

        foreach($users as $user){
        	User::create($user);
        }
    }
}
