# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/looxis/gate.svg?style=flat-square)](https://packagist.org/packages/looxis/gate)
[![Build Status](https://img.shields.io/travis/looxis/gate/master.svg?style=flat-square)](https://travis-ci.org/looxis/gate)
[![Quality Score](https://img.shields.io/scrutinizer/g/looxis/gate.svg?style=flat-square)](https://scrutinizer-ci.com/g/looxis/gate)
[![Total Downloads](https://img.shields.io/packagist/dt/looxis/gate.svg?style=flat-square)](https://packagist.org/packages/looxis/gate)

Gate Connector helps you to connect your oauth client to connect to your oauth server of choice via socialite.
Your default Login automatically redirects to the oauth server.

## Installation

You can install the package via composer:

```bash
composer require looxis/gate
```

## Usage


Add some properties to your `.env` file (see .env.example)
```dotenv
GATE_ENABLED=true
GATE_URL="https://gate.example.com/"
GATE_CLIENT_ID=3
GATE_CLIENT_SECRET=client_secret
```

Publish and Run migration
```shell script
php artisan vendor:publish --tag=gate-migrations
php artisan migrate
```

Add `gate_id` and `api_token` to fillable array in User model.

Also you can change auth callback route and controller in config or in `.env` file
```dotenv
GATE_AUTH_CALLBACK_URI="auth/callback"
GATE_AUTH_CALLBACK_CONTROLLER="App\\Http\\Controllers\\Auth\\LoginController"
```

Change `use AuthenticatesUsers` statement in `App\Http\Controllers\Auth\LoginController` or any other login controller you want to use with Looxis Gate.
```php
use AuthenticatesUsers, LoginControllerTrait {
        LoginControllerTrait::loggedOut insteadof AuthenticatesUsers;
        LoginControllerTrait::showLoginForm insteadof AuthenticatesUsers;
    }
```
`loggedOut` should be called from `logout` method of this controller (if you override it).

Also you can publish the config file with this artisan command:
```shell script
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

If you discover any security related issues, please email dev@looxis.com instead of using the issue tracker.

## Credits

- [Igor Tsapiro](https://github.com/looxis)
- [Mike Cholovskiy](https://github.com/meachel)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).