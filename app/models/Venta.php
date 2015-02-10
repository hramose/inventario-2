<?php

class Venta extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'ventas';

	
    public function proveedor()
    {
        return $this->belongsTo("Proveedor");
    }

    public function vehiculo()
    {
        return $this->belongsTo("Vehiculo");
    }

    public function cliente()
    {
        return $this->belongsTo("Cliente");
    }


}