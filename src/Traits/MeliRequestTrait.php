<?php

declare(strict_types=1);

namespace WandesCardoso\MercadoLivre\Traits;

use WandesCardoso\MercadoLivre\Resource\MeliResource;

trait MeliRequestTrait
{
    public function request(): MeliResource
    {
        return new MeliResource($this);
    }
}
