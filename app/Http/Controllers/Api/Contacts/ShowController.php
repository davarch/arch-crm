<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Contacts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ContactResource;
use App\Http\Responses\Api\ContactResponse;
use Domains\Contacts\Actions\GetContactByUuid;
use Illuminate\Contracts\Support\Responsable;

final class ShowController extends Controller
{
    public function __invoke(GetContactByUuid $contactByUuid, string $uuid): Responsable
    {
        return ContactResponse::make(
            resource: ContactResource::make($contactByUuid($uuid))
        );
    }
}
