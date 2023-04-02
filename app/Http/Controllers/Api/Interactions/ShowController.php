<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Interactions;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\InteractionResource;
use App\Http\Responses\Api\InteractionResponse;
use Domains\Interactions\Actions\GetInteractionByUuid;
use Illuminate\Contracts\Support\Responsable;

final class ShowController extends Controller
{
    public function __invoke(GetInteractionByUuid $interactionByUuid, string $uuid): Responsable
    {
        return InteractionResponse::make(
            data: InteractionResource::make($interactionByUuid($uuid))
        );
    }
}
