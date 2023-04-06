## Introduction

This integration package with Mercado Livre (not the official one)

## Required

- **PHP 8.0+**

## Installation

    composer require wandesnet/mercado-livre:"^1.0"

## Usage

Create a class `Meli` extends from `Meli Connector` and implement the methods requires:

The `refreshTokenExpireIn` method is free for you to implement as per your logic for refreshing the token; See the example below:

Set `setClientId`, `setClientSecret`, `setRedirectUri` change the settings:

```php
final class Meli extends MeliConnector
{
    public function resolveBaseUrl(): string
    {
        return 'https://api.mercadolibre.com';
    }

    protected function defaultOauthConfig(): OAuthConfig
    {
        return OAuthConfig::make()
            ->setClientId('3232321')
            ->setClientSecret('fs4343fs423')
            ->setAuthorizeEndpoint('https://auth.mercadolivre.com.br/authorization')
            ->setRedirectUri('http://my-site.com/callback.php')
            ->setTokenEndpoint('oauth/token');
    }

    protected function refreshTokenExpireIn(): void
    {
        if ($this->hasExpired()) {
            $refresh = $this->refreshAccessToken($this->refresh_token);

            $this->access_token = $refresh->getAccessToken();
            $this->refresh_token = $refresh->getRefreshToken();
            $this->expires_in = $refresh->getExpiresAt()->getTimestamp();
        }
    }
}
```

Example of use `Meli::make()` or `new Meli()`:

```php
$response = Meli::make('access_token', 'refresh_token', 'expire_in')->auth()->request()->order(123456789);
```

Example to generate authentication url in Mercado Livre:

```php
 Meli::make()->getAuthorizationUrl();
```

Example to get `access_token` after authentication in Mercado Livre:

```php
 $authenticator = Meli::make()->getAccessToken($_GET['code']);

var_dump($authenticator->getAccessToken(), $authenticator->getRefreshToken(), $authenticator->getExpiresAt()->getTimestamp());

```

## Tests

    ./vendor/bin/pest

