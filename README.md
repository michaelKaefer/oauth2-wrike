# oauth2-wrike
Wrike OAuth 2.0 support for the PHP League's OAuth 2.0 Client


# Wrike Provider for OAuth 2.0 Client

This package provides Wrike OAuth 2.0 support for the PHP League's [OAuth 2.0 Client](https://github.com/thephpleague/oauth2-client).

## Installation

To install, use composer:

```
composer require michaelkaefer/oauth2-wrike
```

## Usage

Usage is the same as The League's OAuth client, using `MichaelKaefer\OAuth2\Client\Provider\Wrike` as the provider.

### Authorization Code Flow

```php
$provider = new MichaelKaefer\OAuth2\Client\Provider\Amazon([
    'clientId' => 'YOUR_CLIENT_ID',
    'clientSecret' => 'YOUR_CLIENT_SECRET',
    'redirectUri' => 'http://your-redirect-uri',
]);

...
```

### Refreshing A Token

```php
...
```
