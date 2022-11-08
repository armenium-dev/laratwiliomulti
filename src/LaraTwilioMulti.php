<?php

namespace Armenium\LaraTwilioMulti;

use Twilio\Rest\Client;

class LaraTwilioMulti{

	/** @var Twilio\Rest\Client */
	protected $client;
	private $use_account = null;

	public function __construct(Client $client, $use_account = null){
		$this->client = $client;
		$this->use_account = $client;
	}

	public function notify(string $number, string $message, $use_account = null){
		$config = config('laratwiliomulti');
		#dd(1);
		if(is_null($use_account)){
			$use_account = $config['active_account'];
		}

		$sms_from = $config['accounts'][$use_account]['sms_from'];

		return $this->client->messages->create($number, [
			'from' => $sms_from,
			'body' => $message,
		]);
	}
}
