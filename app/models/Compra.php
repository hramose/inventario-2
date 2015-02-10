<?php

class Compra extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'compras';

	/**
	 * Errores devueltos
	 *
	 */
	public $errors;

	/**
	 * Lista de campos que pueden ser llenados con fill
	 *
	 */
	protected $fillable = array('cantidad',
								'costo_unitario', 
								'costo_unitario_iva', 
								'costo_total', 
								'costo_total_iva', 
								'fecha_compra', 
								'fecha_vencimiento',
								'num_factura',
								'num_cheque',
								'producto_id',
								'banco_id', 
								'proveedor_id');

	
	/**
	 * Numero de Registros para paginación
	 *
	 */
	protected $perPage = 10;

	
    public function proveedor()
    {
        return $this->belongsTo("Proveedor");
    }

    public function producto()
    {
        return $this->belongsTo("Producto");
    }

    public function stocks() 
    { 
        return $this->hasOne('Stock','compra_id');
    }

    public function banco()
    {
        return $this->belongsTo("Banco");
    }



    # Validamos los datos enviados por el formulario de creación
    public function isValid($data)
    {
        $rules = array(
        	'cantidad' 	=> 	'Integer',
        	'costo_unitario' 		=> 	'Integer',
        	'costo_unitario_iva'	=>	'Integer',
        	'costo_total'		=>	'Integer',
        	'costo_total_iva'	=>	'Integer',
        	'fecha_compra'		=>  'required|date',
        	'fecha_vencimiento'	=>  'required|date',
        	'num_factura'		=>	'max:150',
        	'num_cheque'		=>  'max:150',
        	'producto_id'	=> 'required|Integer|Min:1',
        	'proveedor_id'	=> 'required|Integer|Min:1',
        	'banco_id'	=> 'required|Integer|Min:1'

        );

        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }

    public function validAndSave($data){
		// Revisamos si la data es válida
		if ($this->isValid($data)){
			// Si la data es valida se la asignamos al usuario
			$this->fill($data);
			// Guardamos el usuario
			$this->save();

			return true;
		}

		return false;
	}


}