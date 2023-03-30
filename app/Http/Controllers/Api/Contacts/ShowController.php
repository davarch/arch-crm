<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Contacts;

use App\Actions\Contacts\GetContactByUuid;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ContactResource;
use App\Http\Responses\ContactResponse;
use Illuminate\Contracts\Support\Responsable;
use JustSteveKing\StatusCode\Http;

final class ShowController extends Controller
{
    public function __invoke(GetContactByUuid $contactByUuid, string $uuid): Responsable
    {
        return ContactResponse::make(
            resource: ContactResource::make(
                $contactByUuid($uuid)
            ),
            status: Http::OK
        );
    }
}
