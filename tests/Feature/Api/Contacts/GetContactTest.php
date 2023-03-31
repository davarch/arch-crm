<?php

declare(strict_types=1);

use App\Models\Contact;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use JustSteveKing\StatusCode\Http;
use function Pest\Laravel\getJson;

it('receives a 401 on get contact when not logged in', function (): void {
    $contact = Contact::factory()->create();

    getJson(route('api:contacts:show', $contact->uuid))
        ->assertStatus(Http::UNAUTHORIZED());
});

it('receives a 404 on get contact with incorrect UUID', function (string $uuid, string $string): void {
    auth()->login(User::factory()->create());

    getJson(route('api:contacts:show', $uuid))
        ->assertStatus(Http::NOT_FOUND());

    getJson(route('api:contacts:show', $string))
        ->assertStatus(Http::NOT_FOUND());
})->with('uuids', 'strings');

it('can retrieve a contact by UUID', function (): void {
    auth()->login(User::factory()->create());

    $contact = Contact::factory()->create();

    getJson(route('api:contacts:show', $contact->uuid))
        ->assertStatus(Http::OK())
        ->assertJson(
            fn (AssertableJson $json) => $json
                ->where('type', 'contacts')
                ->where('attributes.name.first', $contact->first_name)
                ->where('attributes.email', $contact->email)
                ->etc()
        );
});
