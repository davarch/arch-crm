<?php

declare(strict_types=1);

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use JustSteveKing\StatusCode\Http;
use Symfony\Component\HttpFoundation\Response;

final class ContactResponse implements Responsable
{
    public function __construct(
        public readonly JsonResource $resource,
        public readonly Http $status
    ) {
    }

    public static function make(JsonResource $resource, Http $status): ContactResponse
    {
        return new self(
            resource: $resource,
            status: $status
        );
    }

    public function toResponse($request): Response
    {
        return new JsonResponse(
            data: $this->resource,
            status: $this->status->value
        );
    }
}
