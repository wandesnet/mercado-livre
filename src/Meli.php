<?php

declare(strict_types=1);

namespace WandesCardoso\MercadoLivre;

use Saloon\Helpers\OAuth2\OAuthConfig;

final class Meli extends MeliConnector
{
    public function resolveBaseUrl(): string
    {
        return 'https://api.mercadolibre.com';
    }

    protected function defaultOauthConfig(): OAuthConfig
    {
        return OAuthConfig::make()
            ->setClientId('')
            ->setClientSecret('')
            ->setAuthorizeEndpoint('https://auth.mercadolivre.com.br/authorization')
            ->setRedirectUri('http://localhost:8000/callback.php')
            ->setTokenEndpoint('oauth/token');
    }

    protected function refreshTokenExpireIn(): void
    {
        if ($this->hasExpired()) {
            $refresh = $this->refreshAccessToken($this->refresh_token);

            $this->access_token = $refresh->getAccessToken();
            $this->refresh_token = $refresh->getRefreshToken();
            $this->expires_in = $refresh->getExpiresAt()->setTimezone(new \DateTimeZone($this->timeZone))->getTimestamp();
        }
    }
}
