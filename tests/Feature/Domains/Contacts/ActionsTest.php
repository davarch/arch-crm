<?php

declare(strict_types=1);

use App\Models\Contact;
use Domains\Contacts\Actions\CreateNewContact;
use Domains\Contacts\Actions\GetContactByUuid;
use Domains\Contacts\Actions\UpdateContact;
use Domains\Contacts\DataTransferObjects\ContactData;
use Domains\Contacts\Exceptions\ContactNotFound;
use Domains\Contacts\Exceptions\ContactUpdateFailed;
use Illuminate\Contracts\Container\BindingResolutionException;
use function Pest\Laravel\withExceptionHandling;

it('can get a contact', function (): void {
    $contactByFactory = Contact::factory()->create();

    $contact = (new GetContactByUuid())($contactByFactory->uuid);

    expect($contact)
        ->toBeInstanceOf(Contact::class)
        ->and($contact->getAttribute('first_name'))->toEqual($contactByFactory->first_name)
        ->and($contact->getAttribute('email'))->toEqual($contactByFactory->email);
});

it("don't get a contact", function (string $uuid): void {
    withExceptionHandling()
        ->expectException(ContactNotFound::class);

    withExceptionHandling()
        ->expectExceptionMessage("Contact Not Found by UUID [{$uuid}]");

    (new GetContactByUuid())($uuid);
})->with('uuids');

it('can create a new contact', function (string $string): void {
    $contact = (new CreateNewContact())(
        ContactData::from(
            [
                'title' => $string,
                'name' => [
                    'first' => $string,
                    'middle' => $string,
                    'last' => $string,
                    'preferred' => $string,
                ],
                'phone' => $string,
                'email' => "$string@email.com",
            ]
        )
    );

    expect($contact)
        ->toBeInstanceOf(Contact::class)
        ->and($contact->getAttribute('first_name'))->toEqual($string)
        ->and($contact->getAttribute('email'))->toEqual("$string@email.com");
})->with('strings');

it('can update a contact', /** @throws BindingResolutionException */ function (string $string): void {
    $contact = Contact::factory()->create();
    $data = ContactData::from(
        [
            'title' => $string,
            'name' => [
                'first' => $string,
                'middle' => $string,
                'last' => $string,
                'preferred' => $string,
            ],
            'phone' => $string,
            'email' => "$string@email.com",
        ]
    );

    $updateContact = app()->make(UpdateContact::class);
    $updateContact($contact->uuid, $data);

    expect($contact->refresh())
        ->toBeInstanceOf(Contact::class)
        ->and($contact->getAttribute('first_name'))->toEqual($string)
        ->and($contact->getAttribute('email'))->toEqual("$string@email.com");
})->with('strings');

it("don't update a contact", /** @throws BindingResolutionException */ function (string $uuid): void {
    withExceptionHandling()
        ->expectException(ContactUpdateFailed::class);

    withExceptionHandling()
        ->expectExceptionMessage("Failed to update a contact with UUID [{$uuid}]");

    $data = ContactData::from(
        [
            'name' => [
                'first' => $uuid,
            ],
        ]
    );

    $updateContact = app()->make(UpdateContact::class);
    $updateContact($uuid, $data);
})->with('uuids');
