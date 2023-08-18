# This is my package paloma

[![Latest Version on Packagist](https://img.shields.io/packagist/v/revosystems/paloma.svg?style=flat-square)](https://packagist.org/packages/revosystems/paloma)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/revosystems/paloma/run-tests?label=tests)](https://github.com/revosystems/paloma/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/revosystems/paloma/Check%20&%20fix%20styling?label=code%20style)](https://github.com/revosystems/paloma/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/revosystems/paloma.svg?style=flat-square)](https://packagist.org/packages/revosystems/paloma)

## Installation

You can install the package via composer:

```bash
composer require revosystems/paloma
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="paloma-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="paloma-config"
```

This is the contents of the published config file:

```php
return [
    'sms_from' => env('VONAGE_FROM_NUMBER', 'Vonage APIs'),
    'vonage_key' => env('VONAGE_KEY'),
    'vonage_secret' => env('VONAGE_SECRET'),
];
```

## Usage

You can send sms directly using the facade or send sms using the notification feature from laravel.

To send sms directly:
```php
use Revo\Paloma\Facades\Paloma;

Paloma::send(string $phone, string $message, string $service, ?string $from = null)
```
The phone must contain the country code prefix (34 or +34).
A wrong phone will send anything. Vonage cannot validate the phone.

To notify using Paloma you should add the channel and method to your notification:
```php
use Revo\Paloma\PalomaChannel;
use Revo\Paloma\PalomaMessage;

public function via($notifiable)
{
    return [PalomaChannel::class];
}

public function toPaloma($notifiable): PalomaMessage
{
    return new PalomaMessage(string $message, string $service, ?string $from = null);
}
```

Also the notifieble instance should have the $full_phone property.
On a Laravel model can be a computed property as so:

```php
public function getFullPhoneAttribute(): string
{
    return "34" . trim($this->phone);
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [aleixgilaguilar](https://github.com/revosystems)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
