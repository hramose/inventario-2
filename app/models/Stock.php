<?php

class Stock extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'stocks';

	/**
	 * Errores devueltos
	 *
	 */
	public $errors;

	/**
	 * Lista de campos que pueden ser llenados con fill
	 *
	 */
	protected $fillable = array('cantidad', 'compra_id');
	
	/**
	 * Numero de Registros para paginación
	 *
	 */
	protected $perPage = 10;

	
    public function compra()
    {
        return $this->hasOne("Compras");
    }




    # Validamos los datos enviados por el formulario de creación
    public function isValid($data)
    {
        $rules = array(
        	'cantidad' 	=> 	'Integer',
        	'compra_id'	=> 'required|Integer|Min:1'
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