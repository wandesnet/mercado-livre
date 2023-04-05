<?php

declare(strict_types=1);

namespace WandesCardoso\MercadoLivre\Resource;

use Saloon\Http\Connector;
use Saloon\Contracts\MockClient;

abstract class Resource
{
    protected ?MockClient $mockClient = null;

    public function __construct(protected Connector $connector)
    {
    }

   abstract public function setMock(MockClient $mockClient = null): MeliResource;

    protected function getMock(): ?MockClient
    {
        return $this->mockClient;
    }
}
