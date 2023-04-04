<?php

namespace WandesCardoso\MercadoLivre\Request;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetOrderRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(protected int $order_id)
    {
    }

    public function resolveEndpoint(): string
    {
        return "/orders/{$this->order_id}";
    }
}
