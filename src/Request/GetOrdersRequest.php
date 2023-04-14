<?php

declare(strict_types=1);

namespace WandesCardoso\MercadoLivre\Request;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetOrdersRequest extends Request
{
    protected Method $method = Method::GET;

    /** @param array<string, mixed> $params */
    public function __construct(protected int $seller_id, protected int $page, protected int $perPage, protected array $params, protected string $label, protected string $sort)
    {
    }

    public function resolveEndpoint(): string
    {
        return $this->label === 'recent' ? '/orders/search' : '/orders/search/archived';
    }

    protected function defaultQuery(): array
    {
        return array_merge([
            'sort' => $this->sort,
            'offset' => $this->page * $this->perPage,
            'limit' => $this->perPage,
            'seller' => $this->seller_id,
        ], $this->params);
    }
}
