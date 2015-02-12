<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AllTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user', function($table)
		{
			$table->string('username')->unique();
			$table->string('password');
			$table->string('nickname');
			$table->string('remember_token')->nullable();
			$table->timestamps();

			$table->primary('username');
			$table->engine = 'InnoDB';
		});

		Schema::create('status', function($table)
		{
			$table->integer('status_id')->unique();
			$table->string('detail');
			$table->timestamps();

			$table->primary('status_id');
			$table->engine = 'InnoDB';
		});

		Schema::create('surat',function($table)
		{
			$table->string('no')->unique();
			$table->string('perihal');
			$table->string('asal');
			$table->string('keterangan');
			$table->integer('final');
			$table->timestamps();

			$table->primary('no');
			$table->engine = 'InnoDB';
		});

		Schema::create('log',function($table)
		{
			$table->increments('id');
			$table->string('username');
			$table->string('no');
			$table->integer('status_id');
			$table->timestamps();

			$table->foreign('status_id')->references('status_id')->on('status');
			$table->foreign('no')->references('no')->on('surat');
			$table->foreign('username')->references('username')->on('user');
			$table->engine = 'InnoDB';
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('log');
		Schema::dropIfExists('surat');
		Schema::dropIfExists('user');
		Schema::dropIfExists('status');
	}

}
