<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateListingsTable extends Migration {

	public function up()
	{
		Schema::create('listings', function(Blueprint $table) {
			$table->increments('id');
			$table->text('object');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('listings');
	}
}