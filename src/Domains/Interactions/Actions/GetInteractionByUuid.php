<?php

declare(strict_types=1);

namespace Domains\Interactions\Actions;

use App\Models\Interaction;
use Domains\Interactions\Exceptions\InteractionNotFound;
use Illuminate\Database\Eloquent\Model;
use Infrastructure\Exceptions\HttpException;
use Throwable;

final class GetInteractionByUuid
{
    /**
     * @throws HttpException
     */
    public function __invoke(string $uuid): Model
    {
        try {
            return Interaction::query()
                ->where('uuid', $uuid)
                ->firstOrFail();
        } catch (Throwable $throwable) {
            throw new InteractionNotFound(
                uuid: $uuid,
                previous: $throwable
            );
        }
    }
}
