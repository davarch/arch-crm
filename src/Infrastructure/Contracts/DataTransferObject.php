<?php

declare(strict_types=1);

namespace Infrastructure\Contracts;

interface DataTransferObject
{
    /**
     * @return non-empty-array<array-key, mixed>
     */
    public function toArray(): array;
}
