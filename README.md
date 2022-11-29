# Introduction
This is a Laravel package for sending SMS with Twilio

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

### Step Three - Enter values to the DB
Go to the Settings page and create account(s)

Settings page look like this:
```shell
https://YOUR-DOMAIN.com/laratwiliomultisettings
```

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