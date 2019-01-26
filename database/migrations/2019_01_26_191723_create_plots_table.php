<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlotsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('plots', function(Blueprint $table)
		{
			$table->integer('id_plot', true);
			$table->string('morada', 60);
			$table->string('coordenadas', 300);
			$table->string('artigo_marti', 300);
			$table->float('area', 10, 0);
			$table->string('nr_registo', 300);
			$table->string('tipo_solo', 10);
			$table->string('shape_id', 100);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('plots');
	}

}
