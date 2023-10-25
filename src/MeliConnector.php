<?php

declare(strict_types=1);

namespace WandesCardoso\MercadoLivre;

use Saloon\Http\Connector;
use Saloon\Traits\OAuth2\AuthorizationCodeGrant;
use WandesCardoso\MercadoLivre\Traits\MeliRequestTrait;
use WandesCardoso\MercadoLivre\Traits\MeliAuthRequestTrait;
use WandesCardoso\MercadoLivre\Traits\MeliResponse;

abstract class MeliConnector extends Connector
{
    use AuthorizationCodeGrant;
    use MeliRequestTrait;
    use MeliAuthRequestTrait;
    use MeliResponse;

    public function __construct(protected ?string $access_token = null, protected ?string $refresh_token = null, protected ?int $expires_in = null, protected mixed $data = null)
    {
        $this->refreshTokenExpireIn();
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    abstract protected function refreshTokenExpireIn(): void;

    protected function hasExpired(): bool
    {
        return isset($this->access_token, $this->refresh_token, $this->expires_in) && $this->accessTokenAuthenticator()->hasExpired();
    }

    protected function getData(): mixed
    {
        return $this->data;
    }
}
