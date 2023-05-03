# Create Zoom Meetings

[![Latest Version on Packagist](https://img.shields.io/packagist/v/philharmonie/laravel-zoom-meetings.svg?style=flat-square)](https://packagist.org/packages/philharmonie/laravel-zoom-meetings)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/philharmonie/laravel-zoom-meetings/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/philharmonie/laravel-zoom-meetings/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/philharmonie/laravel-zoom-meetings/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/philharmonie/laravel-zoom-meetings/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/philharmonie/laravel-zoom-meetings.svg?style=flat-square)](https://packagist.org/packages/philharmonie/laravel-zoom-meetings)

With this package you can create Zoom meetings from your Laravel application using Server-To-Server OAuth.

## Installation

You can install the package via composer:

```bash
composer require philharmonie/laravel-zoom-meetings
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-zoom-meetings-config"
```

This is the contents of the published config file:

```php
return [
    'account_id' => env('ZOOM_ACCOUNT_ID'),
    'client_id' => env('ZOOM_CLIENT_ID'),
    'client_secret' => env('ZOOM_CLIENT_SECRET'),
    'base_url' => 'https://api.zoom.us/v2/',
    'token_url' => 'https://zoom.us/oauth/token',
];
```

## Preparing your Zoom account

Create a Server-to-Server OAuth app in your Zoom account following this
instruction: https://developers.zoom.us/docs/internal-apps/create/.
You will need the `user:read:admin meeting:write:admin` scopes.

Save the Account ID, Client ID and Client Secret in your `.env` file.

## Usage

```php
$access_token = Auth::getToken();

$meeting = Meeting::setAccessToken($access_token)->create('mail@example.com', [
    'topic' => 'Test Meeting',
    'type' => 2,
    'start_time' => now()->addDay()->startOfHour()->format('Y-m-d\TH:i:s'),
    'duration' => 60,
]);
```

See the test cases for more usage examples.

## Testing

Update the phpunit.xml file with your Zoom API credentials.

```xml

<php>
    <env name="ZOOM_ACCOUNT_ID" value=""/>
    <env name="ZOOM_CLIENT_ID" value=""/>
    <env name="ZOOM_CLIENT_SECRET" value=""/>
    <env name="ZOOM_EMAIL_ACCOUNT" value=""/>
</php>
```

Run

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

If you discover any security-related issues, please email phil@harmonie.media instead of using the issue tracker.

## Credits

- [Phil Harmonie](https://github.com/philharmonie)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
