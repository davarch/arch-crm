<?php

declare(strict_types=1);

namespace Domains\Interactions\Handlers;

use Domains\Interactions\Actions\CreateInteraction;
use Domains\Interactions\Actions\UpdateInteraction;
use Domains\Interactions\Events\InteractionCreated;
use Domains\Interactions\Events\InteractionUpdated;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

final class InteractionHandler extends Projector
{
    public function __construct(
        private readonly CreateInteraction $createInteraction,
        private readonly UpdateInteraction $updateInteraction,
    ) {
    }

    public function onInteractionCreated(InteractionCreated $event): void
    {
        ($this->createInteraction)($event->data);
    }

    public function onInteractionUpdated(InteractionUpdated $event): void
    {
        ($this->updateInteraction)($event->uuid, $event->data);
    }
}
