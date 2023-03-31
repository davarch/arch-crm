<?php

declare(strict_types=1);

namespace Domains\Contacts\Actions;

use Domains\Contacts\Exceptions\ContactUpdateFailed;
use Infrastructure\Contracts\DataTransferObject;
use Throwable;

final class UpdateContact
{
    public function __construct(private readonly GetContactByUuid $contactByUuid)
    {
    }

    public function __invoke(string $uuid, DataTransferObject $data): void
    {
        try {
            $contact = ($this->contactByUuid)($uuid);

            $contact->updateOrFail(
                attributes: array_filter($data->toArray())
            );
        } catch (Throwable $throwable) {
            throw new ContactUpdateFailed(
                uuid: $uuid,
                previous: $throwable
            );
        }
    }
}
