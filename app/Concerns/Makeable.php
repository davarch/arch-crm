<?php

declare(strict_types=1);

namespace App\Concerns;

trait Makeable
{
    public static function make(mixed ...$arguments): self
    {
        /** @phpstan-ignore-next-line  */
        return new self(...$arguments);
    }
}
