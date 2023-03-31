<?php

declare(strict_types=1);

namespace Domains\Contacts\Actions;

use App\Models\Contact;
use Domains\Contacts\Exceptions\ContactNotFound;
use Illuminate\Database\Eloquent\Model;
use Infrastructure\Exceptions\HttpException;
use Throwable;

final class GetContactByUuid
{
    /**
     * @throws HttpException
     */
    public function __invoke(string $uuid): Model
    {
        try {
            return Contact::query()
                ->where('uuid', $uuid)
                ->firstOrFail();
        } catch (Throwable $throwable) {
            throw new ContactNotFound(
                uuid: $uuid,
                previous: $throwable
            );
        }
    }
}
