<?php

namespace Armenium\LaraTwilioMulti;

use App\Models\Recipient;
use Armenium\LaraTwilioMulti\Models\LaraTwilioMultiSettings;
use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use mysql_xdevapi\Schema;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Route;

class LaraTwilioMultiServiceProvider extends ServiceProvider{

	private $configs;

	private function checkAppVersion(){
		$v = app()->version();

		return intval(explode('.', $v)[0]);
	}

	public function register(){
		#Log::stack(['custom'])->debug(__METHOD__);
		#$this->mergeConfigFrom(__DIR__.'/../config/laratwiliomulti.php', 'laratwiliomulti');

		$this->app->bind('laratwiliomulti', function(){
			#$this->ensureConfigValuesAreSet();

			/*$configs = config('laratwiliomulti');
			if(is_null($use_account)){
				$use_account = $config['active_account'];
			}*/

			#$client = new Client(config('laratwiliomulti.account_sid'), config('laratwiliomulti.auth_token'));

			return new LaraTwilioMulti();
		});
	}

	public function boot(){
		if($this->app->runningInConsole()){
			$this->publishFiles();
			$this->registerMigrations();
			#$this->registerRoutes();
		}
		$this->registerViews();
		$this->installRoutes();
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

	protected function publishFiles(){
		#$this->publishes([__DIR__.'/../config/laratwiliomulti.php' => config_path('laratwiliomulti.php')], 'laratwiliomulti-config');
		$this->publishes([__DIR__.'/../public' => public_path('vendor/laratwiliomulti')], 'laratwiliomulti-assets');
		$this->publishes([realpath(__DIR__.'/../views') => resource_path('views/vendor/LaraTwilioMultiViews')], 'laratwiliomulti-views');
	}

	public function registerViews(){
		$this->loadViewsFrom(realpath(__DIR__.'/../views'), 'LaraTwilioMultiViews');
	}

	public function registerMigrations(){
		$this->loadMigrationsFrom(realpath(__DIR__.'/../database/migrations'));

		if(!Schema::hasTable('twilio_settings')){
			if($this->checkAppVersion() < 7){
				Artisan::call('migrate');
			}else{
				Artisan::call('migrate', ['--path' => '/vendor/armenium/laratwiliomulti/database/migrations/2022_11_09_001_create_twilio_settings_table.php']);
			}
		}
	}

	public function registerRoutes(){
		$this->loadRoutesFrom(realpath(__DIR__.'/../routes/web.php'));
	}

	protected function installRoutes(){
		$config = [
			'prefix' => '',
			'middleware' => ['auth', 'role:captain'],
			'namespace' => 'Armenium\LaraTwilioMulti',
		];

		Route::group($config, function(){
			Route::resource('laratwiliomultisettings', 'Controllers\LaraTwilioMultiSettingsController');
		});
	}

}
