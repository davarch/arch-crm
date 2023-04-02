<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Interactions;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\InteractionResource;
use App\Http\Responses\Api\InteractionResponse;
use App\Models\Interaction;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Support\Responsable;

final class IndexController extends Controller
{
    public function __construct(private readonly ?Authenticatable $authenticatable)
    {
    }

    public function __invoke(): Responsable
    {
        $interaction = Interaction::query()
            ->where('user_id', $this->authenticatable?->getAuthIdentifier())
            ->paginate();

        return InteractionResponse::make(
            data: InteractionResource::collection($interaction)
        );
    }
}
