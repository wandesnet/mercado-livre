<?php

declare(strict_types=1);

namespace WandesCardoso\MercadoLivre\Traits;

trait MeliDateTimeImmutableTrait
{
    protected function convertTimeStamp(?int $timeStamp): ?\DateTimeImmutable
    {
        if (isset($timeStamp)) {
            return (new \DateTimeImmutable())->setTimestamp($timeStamp);
        }

        return null;
    }
}
