<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('compras', function($table)
        {
            $table->increments('id');
            
            $table->integer('cantidad');
            $table->integer('costo_unitario');
            $table->integer('costo_unitario_iva');
            $table->integer('costo_total');
            $table->integer('costo_total_iva');

            $table->date('fecha_compra');
            $table->date('fecha_vencimiento');

            $table->string('num_factura', 100);
            $table->string('num_cheque', 100);

             # Llaves Foraneas
			$table->integer('banco_id')->unsigned();
			$table->foreign('banco_id')
			      ->references('id')->on('bancos');

            # Llaves Foraneas
			$table->integer('proveedor_id')->unsigned();
			$table->foreign('proveedor_id')
			      ->references('id')->on('proveedores');

			$table->integer('producto_id')->unsigned();
			$table->foreign('producto_id')
			      ->references('id')->on('productos');

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
		Schema::drop('compras');
	}

}
