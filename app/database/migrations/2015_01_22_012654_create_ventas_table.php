<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ventas', function($table)
        {
            $table->increments('id');
            
            $table->integer('cantidad');
            $table->integer('precio_unitario');
            $table->integer('precio_unitario_iva');
            $table->integer('precio_total');
            $table->integer('precio_total_iva');
            
            

            $table->date('fecha_despacho');
            $table->date('fecha_confirmacion');

            $table->string('num_documento',100);

            # Llaves Foraneas
			$table->integer('producto_id')->unsigned();
			$table->foreign('producto_id')
			      ->references('id')->on('productos');

			$table->integer('vehiculo_id')->unsigned();
			$table->foreign('vehiculo_id')
			      ->references('id')->on('vehiculos');

			$table->integer('cliente_id')->unsigned();
			$table->foreign('cliente_id')
			      ->references('id')->on('clientes');

			$table->integer('estadoventa_id')->unsigned();
			$table->foreign('estadoventa_id')
				  ->references('id')->on('estadoventas');

			$table->boolean('estado')->default(1);


            $table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ventas');
	}

}
