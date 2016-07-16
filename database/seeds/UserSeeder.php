<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        		'nombre'=>'Nelson',
        		'apellido'=>'Gimon',
        		'email'=>'admin@gmail.com',
        		'password'=>bcrypt('admin'), 
        		'perfil'=>'admin'
        	]);
    }
}
