<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Contacts;

use App\Http\Controllers\Controller;
use App\Http\Responses\Api\ContactResponse;
use Domains\Contacts\Actions\CreateNewContact;
use Domains\Contacts\Aggregates\ContactAggregate;
use Domains\Contacts\DataTransferObjects\ContactData;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use JustSteveKing\StatusCode\Http;
use Str;

final class StoreController extends Controller
{
    public function __invoke(Request $request, CreateNewContact $createNewContact): Responsable
    {
        $data = ContactData::validateAndCreate(payload: $request);

        ContactAggregate::retrieve(uuid: Str::uuid()->toString())
            ->createContact(data: $data)
            ->persist();

        return ContactResponse::make(status: Http::ACCEPTED);
    }
}
