<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePropertiesTable extends Migration {

	public function up()
	{
		Schema::create('properties', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('system_id');
			$table->string('name', 255);
			$table->integer('sub_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('properties');
	}
}