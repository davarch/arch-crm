<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Contacts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ContactResource;
use App\Http\Responses\Api\ContactResponse;
use App\Models\Contact;
use Illuminate\Contracts\Support\Responsable;

final class IndexController extends Controller
{
    public function __invoke(): Responsable
    {
        $contacts = Contact::query()->paginate();

        return ContactResponse::make(
            data: ContactResource::collection($contacts)
        );
    }
}
