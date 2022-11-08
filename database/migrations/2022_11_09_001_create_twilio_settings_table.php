<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTwilioSettingsTable extends Migration{

	public function __construct(){
		$this->table = 'twilio_settings';
	}

	/**
	 * Run the migrations.
	 *
	 */
	public function up(){
		if(!Schema::hasTable($this->table)){
			Schema::create($this->table, function(Blueprint $table){
				$table->increments('id');
				$table->string('name')->nullable();
				$table->string('sms_from')->nullable();
				$table->string('account_sid')->nullable();
				$table->string('auth_token')->nullable();
				$table->integer('default')->default(0);
				$table->string('rules')->nullable();
				$table->timestamps();
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 */
	public function down(){
		if(Schema::hasTable($this->table)){
			Schema::drop($this->table);
		}
	}
}
