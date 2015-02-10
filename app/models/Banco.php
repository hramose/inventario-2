<?php

class Banco extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'bancos';

	public function compras() 
    { 
        return $this->hasMany('Compra'); 
    } 


}