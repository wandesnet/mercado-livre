<?php

declare(strict_types=1);

namespace WandesCardoso\MercadoLivre\Traits;

use Saloon\Http\Auth\AccessTokenAuthenticator;
use WandesCardoso\MercadoLivre\MeliConnector;

trait MeliAuthRequestTrait
{
    use MeliDateTimeImmutableTrait;

    protected function accessTokenAuthenticator(): AccessTokenAuthenticator
    {
        return new AccessTokenAuthenticator((string) $this->access_token, $this->refresh_token, $this->convertTimeStamp($this->expires_in));
    }

    public function auth(): MeliConnector
    {
        return $this->authenticate($this->accessTokenAuthenticator());
    }
}
