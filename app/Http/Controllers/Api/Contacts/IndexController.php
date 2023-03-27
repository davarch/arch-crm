<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Contacts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ContactResource;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class IndexController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $contacts = Contact::query()->paginate();

        return new JsonResponse(
            data: ContactResource::collection(
                resource: $contacts
            ),
            status: Response::HTTP_OK
        );
    }
}
