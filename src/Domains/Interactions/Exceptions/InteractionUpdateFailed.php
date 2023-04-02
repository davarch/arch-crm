<?php

declare(strict_types=1);

namespace Domains\Interactions\Exceptions;

use Infrastructure\Exceptions\HttpException;
use JustSteveKing\StatusCode\Http;
use Throwable;

final class InteractionUpdateFailed extends HttpException
{
    public function __construct(
        string $uuid,
        ?Throwable $previous = null,
    ) {
        parent::__construct(
            message: "Failed to update a interaction with UUID [{$uuid}]",
            previous: $previous,
            statusCode: Http::NOT_FOUND
        );
    }
}
