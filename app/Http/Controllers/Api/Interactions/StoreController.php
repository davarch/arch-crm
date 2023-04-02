<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Interactions;

use App\Http\Controllers\Controller;
use App\Http\Responses\Api\InteractionResponse;
use Domains\Interactions\Aggregates\InteractionAggregate;
use Domains\Interactions\DataTransferObjects\InteractionData;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use JustSteveKing\StatusCode\Http;
use Str;

final class StoreController extends Controller
{
    public function __construct(private readonly ?Authenticatable $authenticatable)
    {
    }

    public function __invoke(Request $request): Responsable
    {
        $data = InteractionData::validateAndCreate(
            payload: [
                ...$request->all(),
                'user' => $this->authenticatable?->getAuthIdentifier(),
            ]
        );

        InteractionAggregate::retrieve(uuid: Str::uuid()->toString())
            ->createInteraction(data: $data)
            ->persist();

        return InteractionResponse::make(status: Http::ACCEPTED);
    }
}
