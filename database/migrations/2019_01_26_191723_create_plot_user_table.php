<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlotUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('plot_user', function(Blueprint $table)
		{
			$table->integer('id_plot_user', true);
			$table->integer('id_plot')->index('plot_user_ibfk_1');
			$table->integer('id_user')->index('plot_user_ibfk_2');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('plot_user');
	}

}
