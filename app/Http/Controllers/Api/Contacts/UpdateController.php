<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Contacts;

use App\Actions\Contacts\UpdateContact;
use App\DataTransferObjects\ContactData;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ContactResource;
use App\Http\Responses\Api\ContactResponse;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

final class UpdateController extends Controller
{
    public function __invoke(
        Request $request,
        UpdateContact $updateContact,
        string $uuid
    ): Responsable {
        $data = ContactData::validateAndCreate($request);

        return ContactResponse::make(
            resource: ContactResource::make(
                $updateContact($uuid, $data)
            )
        );
    }
}
