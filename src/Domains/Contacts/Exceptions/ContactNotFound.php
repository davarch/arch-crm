<?php

declare(strict_types=1);

namespace Domains\Contacts\Exceptions;

use Infrastructure\Exceptions\HttpException;
use JustSteveKing\StatusCode\Http;
use Throwable;

final class ContactNotFound extends HttpException
{
    public function __construct(
        string $uuid,
        ?Throwable $previous = null,
    ) {
        parent::__construct(
            message: "Contact Not Found by UUID [{$uuid}]",
            previous: $previous,
            statusCode: Http::NOT_FOUND
        );
    }
}
