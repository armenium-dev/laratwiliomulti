# Introduction
This is a Laravel package for sending SMS using the Twilio service using Twilio multi-accounts and patterns for automatically selecting an "sms_from" number.

### Step One - Installation

Require the package via composer into your project

```shell
composer require armenium/laratwiliomulti
```

### Step Two - Publishing Configurations
To publish the view files, run:

```shell
php artisan vendor:publish --tag=laratwiliomulti-views
```

To publish the asset (js, css) files, run:

```shell
php artisan vendor:publish --tag=laratwiliomulti-assets
```

### Step Three - Enter values in DB
Go to the Settings page and create an account(s)

On your site, the link to the settings page will look like this:

```shell
https://YOUR-DOMAIN.com/laratwiliomultisettings
```
_(Replace YOUR-DOMAIN.com with your real domain)_

### Usage
To send a SMS message, you can use the `notify()` method available on the `LaraTwilioMulti` Facade

```php
<?php

use Armenium\LaraTwilioMulti\Facades\LaraTwilioMulti;

$sendSms = LaraTwilioMulti::notify('+1234567890', 'Hello')

return $sendSms;
```

## Contributing

Want to contribute to this package? Read our [contributor guidelines](CONTRIBUTING.md) to get set up.

## License

This package is released under the [MIT License](LICENSE.md).