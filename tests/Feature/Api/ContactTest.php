<?php

declare(strict_types=1);

use App\Models\Contact;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use JustSteveKing\StatusCode\Http;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;

it('receives a 401 on get contacts when not logged in', function () {
    getJson(route('api:contacts:index'))
        ->assertStatus(Http::UNAUTHORIZED());
});

it('i can a retrieve a list of contacts for a user', function () {
    auth()->login(User::factory()->create());

    Contact::factory(10)->create();

    getJson(route('api:contacts:index'))
        ->assertStatus(Http::OK())
        ->assertJson(
            fn (AssertableJson $json) => $json->count(10)->first(
                fn (AssertableJson $json) => $json->where('type', 'contacts')->etc()
            )
        );
});

it('receives a 401 on create contact when not logged in', function (string $string) {
    getJson(
        route('api:contacts:store'),
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
        ->assertStatus(Http::UNAUTHORIZED());
})->with('strings');

it('can create a new contact', function (string $string) {
    auth()->login(User::factory()->create());

    expect(Contact::query()->count())->toEqual(0);

    postJson(
        route('api:contacts:store'),
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
        ->assertStatus(Http::CREATED())
        ->assertJson(
            fn (AssertableJson $json) => $json
                ->where('type', 'contacts')
                ->where('attributes.name.first', $string)
                ->where('attributes.email', "$string@email.com")
                ->etc()
        );

    expect(Contact::query()->count())->toEqual(1);
})->with('strings');

it('receives a 401 on get contact when not logged in', function () {
    $contact = Contact::factory()->create();

    getJson(route('api:contacts:show', $contact->uuid))
        ->assertStatus(Http::UNAUTHORIZED());
});

it('receives a 404 on get contact with incorrect UUID', function (string $uuid) {
    auth()->login(User::factory()->create());

    getJson(route('api:contacts:show', $uuid))
        ->assertStatus(Http::NOT_FOUND());
})->with('uuids');

it('can retrieve a contact by UUID', function () {
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
