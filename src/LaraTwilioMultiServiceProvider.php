<?php

namespace Armenium\LaraTwilioMulti;

use Exception;
use Illuminate\Support\ServiceProvider;
use Twilio\Rest\Client;

class LaraTwilioMultiServiceProvider extends ServiceProvider{

	public function register(){
		$this->mergeConfigFrom(__DIR__.'/../config/laratwiliomulti.php', 'laratwiliomulti');

		$this->app->bind('laratwiliomulti', function(){
			$this->ensureConfigValuesAreSet();

			$configs = config('laratwiliomulti');

			if(is_null($use_account)){
				$use_account = $config['active_account'];
			}

			$client = new Client(config('laratwiliomulti.account_sid'), config('laratwiliomulti.auth_token'));

			return new LaraTwilioMulti($client);
		});
	}

	public function boot(){
		if($this->app->runningInConsole()){
			$this->publishConfig();
		}
	}

	protected function ensureConfigValuesAreSet(){
		$configs = config('laratwiliomulti');

		foreach($configs as $k => $elements){
			foreach($elements['accounts'] as $account_key => $mandatoryAttributes){
				foreach($mandatoryAttributes as $key => $value){
					if(empty($value)){
						throw new Exception("Please provide a value for ${key}");
					}
				}
			}
		}
	}

	protected function publishConfig(){
		$this->publishes([
			__DIR__.'/../config/laratwiliomulti.php' => config_path('laratwiliomulti.php'),
		], 'laratwiliomulti-config');
	}
}
