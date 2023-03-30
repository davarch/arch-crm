<?php

declare(strict_types=1);

namespace App\Actions\Contacts;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Model;

final class GetContactByUuid
{
    public function __invoke(string $uuid): Model
    {
        return Contact::query()
            ->where('uuid', '=', $uuid)
            ->firstOrFail();
    }
}
