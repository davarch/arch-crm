<?php

declare(strict_types=1);

namespace Domains\Interactions\Events;

use Domains\Interactions\DataTransferObjects\InteractionData;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

final class InteractionCreated extends ShouldBeStored
{
    public function __construct(public readonly InteractionData $data)
    {
    }
}
