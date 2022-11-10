# Introduction
This is a Laravel package for sending SMS with Twilio

### Step One - Installation

Require the package via composer into your project

```shell
composer require armenium/laratwiliomulti
```

### Step Two - Publishing Configurations
To publish the config file, run:

`php artisan vendor:publish --tag=laratwiliomulti-config`

To publish the public files, run:

`php artisan vendor:publish --tag=laratwiliomulti-public`

This is the content of the config file that will be published at `config/laratwiliomulti.php`

```php
<?php
    return [
    'account_sid' => env('TWILIO_ACCOUNT_SID'),
    'auth_token' => env('TWILIO_AUTH_TOKEN'),
    'sms_from' => env('TWILIO_SMS_FROM'),
   ];
```
Next, edit your `.env` file with your Twilio Credentials

```bash
TWILIO_ACCOUNT_SID=xxxx
TWILIO_AUTH_TOKEN=xxxx
TWILIO_SMS_FROM=xxxx
```


### Usage
To send a SMS message, you can use the `notify()` method available on the `LaraTwilioMulti` Facade

```php
<?php

use Armenium\LaraTwilioMulti\Facades\LaraTwilioMulti;

$sendSms = LaraTwilioMulti::notify('+2341234567892', 'Hello')

return $sendSms;
```

## Contributing

Want to contribute to this package? Read our [contributor guidelines](CONTRIBUTING.md) to get set up.

## License

This package is released under the [MIT License](LICENSE.md).