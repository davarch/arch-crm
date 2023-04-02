<?php

declare(strict_types=1);

namespace App\Http\Responses\Api\Concerns;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JustSteveKing\StatusCode\Http;
use Symfony\Component\HttpFoundation\Response;

/**
 * @property-read mixed $data
 * @property-read Http $status
 */
trait SendsJsonResponse
{
    /**
     * @param  Request  $request
     */
    public function toResponse($request): Response
    {
        return new JsonResponse(
            data: $this->data,
            status: $this->status->value
        );
    }
}
