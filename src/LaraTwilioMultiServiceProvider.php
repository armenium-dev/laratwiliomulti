<?php

namespace Armenium\LaraTwilioMulti;

use App\Models\Recipient;
use Exception;
use Illuminate\Support\ServiceProvider;
use Twilio\Rest\Client;

class LaraTwilioMultiServiceProvider extends ServiceProvider{

	private $configs;

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
			#$this->registerViews();
			$this->registerMigrations();
		}
	}

	protected function ensureConfigValuesAreSet(){
		$configs = config('laratwiliomulti');
		#$r = Recipient::find(288);
		#dd($r);
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
		$this->publishes([__DIR__.'/../config/laratwiliomulti.php' => config_path('laratwiliomulti.php')], 'laratwiliomulti-config');
	}

	public function registerViews(){
		$this->loadViewsFrom(__DIR__.'/../views', 'laravel-email-templates');
		$this->publishes([__DIR__.'/../views' => resource_path('views/vendor/laravel-email-templates')]);
	}

	public function registerMigrations(){
		#$this->loadMigrationsFrom(__DIR__.'/../database/migrations');
		$this->loadMigrationsFrom(realpath(__DIR__.'/../database/migrations'));
		$this->artisan('migrate');
	}

}
