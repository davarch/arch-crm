<?php

declare(strict_types=1);

namespace Domains\Interactions\Actions;

use App\Models\Interaction;
use Illuminate\Database\Eloquent\Model;
use Infrastructure\Contracts\DataTransferObject;

final class CreateInteraction
{
    public function __invoke(DataTransferObject $data): Model
    {
        return Interaction::query()->create(
            attributes: $data->toArray()
        );
    }
}
