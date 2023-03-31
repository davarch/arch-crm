<?php

declare(strict_types=1);

use App\Models\Contact;
use Domains\Contacts\DataTransferObjects\ContactData;
use Domains\Contacts\Events\ContactCreated;
use Domains\Contacts\Events\ContactUpdated;
use Domains\Contacts\Handlers\ContactHandler;
use Illuminate\Contracts\Container\BindingResolutionException;

it('can store a new contact', /** @throws BindingResolutionException */ function (string $string): void {
    $event = new ContactCreated(
        data: ContactData::from(
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

    expect($event)->toBeInstanceOf(ContactCreated::class);

    $handler = app()->make(ContactHandler::class);
    expect(Contact::query()->count())->toEqual(0);

    $handler->onContactCreated($event);
    expect(Contact::query()->count())->toEqual(1);
})->with('strings');

it('can update a contact', /** @throws BindingResolutionException */ function (string $string): void {
    $contact = Contact::factory()->create();

    $event = new ContactUpdated(
        uuid: $contact->uuid,
        data: ContactData::from(
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

    expect($event)->toBeInstanceOf(ContactUpdated::class);

    $handler = app()->make(ContactHandler::class);
    $handler->onContactUpdated($event);

    $contact->refresh();
    expect($contact->getAttribute('first_name'))->toEqual($string);
})->with('strings');
