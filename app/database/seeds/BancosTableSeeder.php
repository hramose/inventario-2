<?php

/**
* Agregamos un usuario nuevo a la base de datos.
*/

class BancosTableSeeder extends Seeder {

    public function run(){

        Banco::create(array(
            'nombre'     => 'Banco Chile'
        ));

        Banco::create(array(
            'nombre'     => 'Banco Santander'
        ));
    }

}