<?php

declare(strict_types=1);

namespace Domains\Interactions\Aggregates;

use Domains\Interactions\DataTransferObjects\InteractionData;
use Domains\Interactions\Events\InteractionCreated;
use Domains\Interactions\Events\InteractionUpdated;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

final class InteractionAggregate extends AggregateRoot
{
    public function createInteraction(InteractionData $data): self
    {
        $this->recordThat(
            domainEvent: new InteractionCreated(
                data: $data
            )
        );

        return $this;
    }

    public function updateInteraction(string $uuid, InteractionData $data): self
    {
        $this->recordThat(
            domainEvent: new InteractionUpdated(
                uuid: $uuid,
                data: $data
            )
        );

        return $this;
    }
}
