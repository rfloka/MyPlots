<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mails', function(Blueprint $table)
		{
			$table->integer('id_mensagem', true);
			$table->string('assunto', 50);
			$table->string('texto', 1000);
			$table->string('de', 60);
			$table->string('para', 60);
			$table->date('data');
			$table->boolean('visto');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mails');
	}

}
