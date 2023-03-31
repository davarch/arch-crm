<?php

declare(strict_types=1);

use App\Models\Contact;
use App\Models\User;
use JustSteveKing\StatusCode\Http;
use function Pest\Laravel\getJson;
use function Pest\Laravel\putJson;
use Spatie\EventSourcing\StoredEvents\Models\EloquentStoredEvent;

it('receives a 401 on update contact when not logged in', function (): void {
    $contact = Contact::factory()->create();

    getJson(route('api:contacts:update', $contact->uuid))
        ->assertStatus(Http::UNAUTHORIZED());
});

it('receives a 404 on update contact with incorrect UUID', function (string $uuid, string $string): void {
    auth()->login(User::factory()->create());

    getJson(route('api:contacts:update', $uuid))
        ->assertStatus(Http::NOT_FOUND());

    getJson(route('api:contacts:update', $string))
        ->assertStatus(Http::NOT_FOUND());
})->with('uuids', 'strings');

it('can update a contact', function (string $string): void {
    auth()->login(User::factory()->create());

    $contact = Contact::factory()->create();

    expect(EloquentStoredEvent::query()->count())->toEqual(0);

    putJson(
        route('api:contacts:update', $contact->uuid),
        [
            'title' => $string,
            'name' => [
                'first' => $string,
            ],
            'phone' => $string,
        ]
    )->assertStatus(Http::ACCEPTED());

    expect(EloquentStoredEvent::query()->count())->toEqual(1);
})->with('strings');
