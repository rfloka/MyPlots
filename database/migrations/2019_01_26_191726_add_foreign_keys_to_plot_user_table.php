<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPlotUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('plot_user', function(Blueprint $table)
		{
			$table->foreign('id_plot', 'plot_user_ibfk_1')->references('id_plot')->on('plots')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('id_user', 'plot_user_ibfk_2')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('plot_user', function(Blueprint $table)
		{
			$table->dropForeign('plot_user_ibfk_1');
			$table->dropForeign('plot_user_ibfk_2');
		});
	}

}
