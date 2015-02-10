<?php

/**
* Agregamos un usuario nuevo a la base de datos.
*/

class UsersTableSeeder extends Seeder {

    public function run(){

        User::create(array(
            'email'     => 'admin@admin.com',
            'username' 	=> 'admin',
            'full_name' => 'Administrator',
            'password' 	=> 'admin' // Hash::make() nos va generar una cadena con nuestra contraseña encriptada
        ));
    }

}