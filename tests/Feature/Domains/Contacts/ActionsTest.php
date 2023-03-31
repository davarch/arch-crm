<?php

declare(strict_types=1);

use App\Models\Contact;
use Domains\Contacts\Actions\CreateNewContact;
use Domains\Contacts\Actions\UpdateContact;
use Domains\Contacts\DataTransferObjects\ContactData;
use Illuminate\Contracts\Container\BindingResolutionException;

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
