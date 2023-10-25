<?php

namespace WandesCardoso\MercadoLivre\Traits;

use Exception;
use Saloon\Http\Response;
use Throwable;
use WandesCardoso\MercadoLivre\Exception\MeliException;

trait MeliResponse
{
    /** @throws Exception */
    public function getRequestException(Response $response, ?Throwable $senderException): ?Throwable
    {
        return new MeliException($response->body(), $response->status());
    }
}
