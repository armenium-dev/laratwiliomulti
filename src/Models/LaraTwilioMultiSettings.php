<?php

namespace Armenium\LaraTwilioMulti\Models;

use Armenium\LaraTwilioMulti\Casts\Json;
use Illuminate\Database\Eloquent\Model;

class LaraTwilioMultiSettings extends Model{

	public $table = 'twilio_settings';

	/**
	 * The attributes that could be used in mass assignment.
	 * @var array
	 */
	protected $fillable = [
		'name',
		'account_sid',
		'auth_token',
		'params',
		'order',
		'active',
	];

	protected $casts = [
		'params' => Json::class,
		#'created_at' => 'datetime:Y-m-d H:i',
		#'updated_at' => 'datetime:Y-m-d H:i',
	];

}
