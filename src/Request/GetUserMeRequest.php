<?php

declare(strict_types=1);

namespace WandesCardoso\MercadoLivre\Request;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetUserMeRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(protected ?string $id = null)
    {
    }

    public function resolveEndpoint(): string
    {
        return isset($this->id) ? "/users/{$this->id}" : '/users/me';
    }
}
