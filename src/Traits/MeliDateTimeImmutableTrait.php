<?php

declare(strict_types=1);

namespace WandesCardoso\MercadoLivre\Traits;

trait MeliDateTimeImmutableTrait
{
    protected string $timeZone = 'America/Sao_Paulo';

    protected function convertTimeStamp(?int $timeStamp): ?\DateTimeImmutable
    {
        if (isset($timeStamp)) {
            return (new \DateTimeImmutable())->setTimezone(new \DateTimeZone($this->timeZone))->setTimestamp($timeStamp);
        }

        return null;
    }

    protected function setTimezone(string $timeZone): void
    {
        $this->timeZone = $timeZone;
    }
}
