<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemTable extends Migration {

	public function up()
	{
		Schema::create('item', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('system_id');
			$table->text('name');
			$table->string('price', 255);
			$table->string('sku', 255);
			$table->string('discount', 255);
			$table->tinyInteger('offer')->default('0');
			$table->tinyInteger('prime')->default('0');
			$table->text('object');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('item');
	}
}