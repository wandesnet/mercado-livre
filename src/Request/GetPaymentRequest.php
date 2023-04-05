<?php

declare(strict_types=1);

namespace WandesCardoso\MercadoLivre\Request;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetPaymentRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(protected int $pay_id)
    {
    }

    public function resolveEndpoint(): string
    {
        return "/collections/{$this->pay_id}";
    }
}
