<?php

declare(strict_types=1);

namespace App\Actions\Contacts;

use App\Contracts\DataTransferObject;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Model;

final class CreateNewContact
{
    public function __invoke(DataTransferObject $data): Model
    {
        return Contact::query()->create(
            attributes: $data->toArray()
        );
    }
}
