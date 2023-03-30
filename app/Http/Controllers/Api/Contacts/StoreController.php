<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Contacts;

use App\Actions\Contacts\CreateNewContact;
use App\DataTransferObjects\ContactData;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ContactResource;
use App\Http\Responses\Api\ContactResponse;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use JustSteveKing\StatusCode\Http;

final class StoreController extends Controller
{
    public function __invoke(Request $request, CreateNewContact $createNewContact): Responsable
    {
        $contact = $createNewContact(
            data: ContactData::validateAndCreate(
                payload: $request
            )
        );

        return ContactResponse::make(
            resource: ContactResource::make($contact),
            status: Http::CREATED
        );
    }
}
