<?php

declare(strict_types=1);

namespace App\Actions\Contacts;

use App\Contracts\DataTransferObject;
use Illuminate\Database\Eloquent\Model;

final class UpdateContact
{
    public function __construct(private readonly GetContactByUuid $contactByUuid)
    {
    }

    public function __invoke(string $uuid, DataTransferObject $data): Model
    {
        $contact = ($this->contactByUuid)($uuid);

        return tap($contact, static fn (Model $contact) => $contact
            ->update(
                attributes: array_filter($data->toArray())
            )
        );
    }
}
