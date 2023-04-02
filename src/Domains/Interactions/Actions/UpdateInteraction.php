<?php

declare(strict_types=1);

namespace Domains\Interactions\Actions;

use Domains\Interactions\Exceptions\InteractionUpdateFailed;
use Infrastructure\Contracts\DataTransferObject;
use Throwable;

final class UpdateInteraction
{
    public function __construct(private readonly GetInteractionByUuid $interactionByUuid)
    {
    }

    public function __invoke(string $uuid, DataTransferObject $data): void
    {
        try {
            $interaction = ($this->interactionByUuid)($uuid);

            $interaction->updateOrFail(
                attributes: array_filter($data->toArray())
            );
        } catch (Throwable $throwable) {
            throw new InteractionUpdateFailed(
                uuid: $uuid,
                previous: $throwable
            );
        }
    }
}
