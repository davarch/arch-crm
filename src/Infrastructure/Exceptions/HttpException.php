<?php

declare(strict_types=1);

namespace Infrastructure\Exceptions;

use JustSteveKing\StatusCode\Http;
use RuntimeException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

abstract class HttpException extends RuntimeException implements HttpExceptionInterface
{
    /**
     * @param  array<string, string|int>  $headers
     */
    public function __construct(
        string $message,
        int $code = 0,
        ?Throwable $previous = null,
        private readonly array $headers = [],
        private readonly Http $statusCode = Http::INTERNAL_SERVER_ERROR,
    ) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return array<string, string|int>
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode->value;
    }
}
