<?php

declare(strict_types=1);

namespace WandesCardoso\MercadoLivre\Request;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetShipmentRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(protected int $shipment_id)
    {
    }

    public function resolveEndpoint(): string
    {
        return "/shipments/{$this->shipment_id}";
    }
}
