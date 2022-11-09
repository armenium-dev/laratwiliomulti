<?php

namespace Armenium\LaraTwilioMulti\Models;

use Illuminate\Database\Eloquent\Model;

class LaraTwilioMultiSettings extends Model{

	public $table = 'twilio_settings';

	/**
	 * The attributes that could be used in mass assignment.
	 * @var array
	 */
	protected $fillable = [
		'name',
		'sms_from',
		'account_sid',
		'auth_token',
	];

}
