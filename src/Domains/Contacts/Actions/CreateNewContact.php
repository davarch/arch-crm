<?php

declare(strict_types=1);

namespace Domains\Contacts\Actions;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Model;
use Infrastructure\Contracts\DataTransferObject;

final class CreateNewContact
{
    public function __invoke(DataTransferObject $data): Model
    {
        return Contact::query()->create(
            attributes: $data->toArray()
        );
    }
}
