<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Contacts;

use App\Http\Controllers\Controller;
use App\Http\Responses\Api\ContactResponse;
use Domains\Contacts\Aggregates\ContactAggregate;
use Domains\Contacts\DataTransferObjects\ContactData;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use JustSteveKing\StatusCode\Http;

final class UpdateController extends Controller
{
    public function __invoke(Request $request, string $uuid): Responsable
    {
        $data = ContactData::validateAndCreate($request);

        ContactAggregate::retrieve(uuid: $uuid)
            ->updateContact(uuid: $uuid, data: $data)
            ->persist();

        return ContactResponse::make(
            status: Http::ACCEPTED
        );
    }
}
