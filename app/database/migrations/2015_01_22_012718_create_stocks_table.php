<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stocks', function($table)
        {
            $table->increments('id');
            
            $table->integer('cantidad');

            # Llaves Foraneas

			$table->integer('compra_id')->unsigned();
			$table->foreign('compra_id')
			      ->references('id')->on('compras');

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
		Schema::drop('stocks');
	}

}
