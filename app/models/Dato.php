<?php

class Dato extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'datos';

	/**
	 * Errores devueltos
	 *
	 */
	public $errors;

	/**
	 * Lista de campos que pueden ser llenados con fill
	 *
	 */
	protected $fillable = array('nombre', 'valor');
	
	/**
	 * Numero de Registros para paginación
	 *
	 */
	protected $perPage = 10;

	

	# Validamos los datos enviados por el formulario de creación
    public function isValid($data)
    {
        $rules = array(
        	'nombre' 	=> 	'required|min:2|max:150',
        	'valor' 	=> 	'Integer'
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