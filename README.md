# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/looxis/gate.svg?style=flat-square)](https://packagist.org/packages/looxis/gate)
[![Build Status](https://img.shields.io/travis/looxis/gate/master.svg?style=flat-square)](https://travis-ci.org/looxis/gate)
[![Quality Score](https://img.shields.io/scrutinizer/g/looxis/gate.svg?style=flat-square)](https://scrutinizer-ci.com/g/looxis/gate)
[![Total Downloads](https://img.shields.io/packagist/dt/looxis/gate.svg?style=flat-square)](https://packagist.org/packages/looxis/gate)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require looxis/gate
```

## Usage


To register your provider, add it to the array into `config/app.php` file:
```php
'providers' => [
    // Other Service Providers

     \Looxis\Gate\GateServiceProvider::class
],
```


Add some properties to your `.env` file (see .env.example)
```php
GATE_ENABLED=true
GATE_URL="https://gate.example.com/"
GATE_CLIENT_ID=3
GATE_CLIENT_SECRET=client_secret
```

Also you can publish the config file with this artisan command:
``` php
php artisan vendor:publish --tag=gate-config
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email igortsapiro@gmail.com instead of using the issue tracker.

## Credits

- [Igor Tsapiro](https://github.com/looxis)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).