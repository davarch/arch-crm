<?php

declare(strict_types=1);

namespace App\Http\Responses\Api;

use App\Concerns\Makeable;
use App\Http\Responses\Api\Concerns\SendsJsonResponse;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Resources\Json\JsonResource;
use JustSteveKing\StatusCode\Http;

final class ContactResponse implements Responsable
{
    use Makeable;
    use SendsJsonResponse;

    public function __construct(
        public readonly ?JsonResource $data = null,
        public readonly Http $status = Http::OK
    ) {
    }
}
