<?php

namespace Armenium\LaraTwilioMulti;

use Armenium\LaraTwilioMulti\Models\LaraTwilioMultiSettings;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class LaraTwilioMulti{

	/** @var Twilio\Rest\Client */
	protected $client;
	private $accounts = null;
	private $account_id = null;
	private $account_sid = null;
	private $auth_token = null;
	private $sms_from = null;

	public function __construct(){
		#Log::stack(['custom'])->debug(__METHOD__);
		$this->getActiveAccounts();
		#dd($this->accounts);
		#$this->client = $client;
	}

	public function notify(string $number, string $message){
		#Log::stack(['custom'])->debug(__METHOD__);

		$this->setActiveClientByNumber($number);

		/*Log::stack(['custom'])->debug([
			'account_sid' => $this->account_sid,
			'auth_token' => $this->auth_token,
			'sms_from' => $this->sms_from,
			'user_number' => $number,
		]);*/

		#$config = config('laratwiliomulti');
		/*if(is_null($use_account)){
			$use_account = $config['active_account'];
		}*/

		/** @var Twilio\Rest\Client */
		$client = new Client($this->account_sid, $this->auth_token);

		return $client->messages->create($number, [
			'from' => $this->sms_from,
			'body' => $message,
		]);
	}

	private function getActiveAccounts(){
		#Log::stack(['custom'])->debug(__METHOD__);

		$accounts = LaraTwilioMultiSettings::where(['active' => 1])
			->whereNotNull('account_sid')
			->whereNotNull('auth_token')
			->get();

		#Log::stack(['custom'])->debug($accounts);

		if($accounts->count()){
			foreach($accounts as $account){
				$params = json_decode($account->params, true, JSON_NUMERIC_CHECK);
				$this->accounts[$account->id] = [
					'account_sid' => $account->account_sid,
					'auth_token' => $account->auth_token,
					'params' => [],
				];
				if(!empty($params)){
					foreach($params as $k => $param){
						if(!isset($param['active']) || $param['active'] != 1){
							unset($params[$k]);
						}
					}
					$this->accounts[$account->id]['params'] = $params;
				}
			}
		}

	}

	private function setActiveClientByNumber(string $user_number){
		#Log::stack(['custom'])->debug(__METHOD__);

		#Log::stack(['custom'])->debug($this->accounts);

		if(is_null($this->accounts)) return;

		$default_sms_from = null;
		foreach($this->accounts as $account){
			#$this->account_id = $account['id'];
			$this->account_sid = $account['account_sid'];
			$this->auth_token = $account['auth_token'];

			foreach($account['params'] as $param){
				if(isset($param['default']) && $param['default'] == 1){
					$default_sms_from = $param['sms_from'];
				}

				if(empty($param['pattern'])) continue;

				if($this->is_match($user_number, $param['pattern'])){
					$this->sms_from = $param['sms_from'];
					break;
				}
			}
		}

		if(is_null($this->sms_from)){
			$this->sms_from = $default_sms_from;
		}
	}

	private function is_match(string $user_number, string $pattern): bool{
		#Log::stack(['custom'])->debug(__METHOD__);

		$prefix = '';
		if(substr($pattern, 0, 1) == '*'){
			$prefix = '([^\+])';
		}elseif(substr($pattern, 0, 1) == '+'){
			$prefix = '(\+)';
		}

		$pattern = '/'.$prefix.str_replace('*', '(.*)', $pattern).'/';
		#dd($pattern);
		$output_array = [];
		preg_match($pattern, $user_number, $output_array);

		return !empty($output_array) && isset($output_array[0]);
	}

}
