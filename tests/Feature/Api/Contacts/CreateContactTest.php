<?php

declare(strict_types=1);

use App\Models\User;
use JustSteveKing\StatusCode\Http;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;
use Spatie\EventSourcing\StoredEvents\Models\EloquentStoredEvent;

it('receives a 401 on create contact when not logged in', function (string $string): void {
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

it('can create a new contact', function (string $string): void {
    auth()->login(User::factory()->create());

    expect(EloquentStoredEvent::query()->count())->toEqual(0);

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
        ->assertStatus(Http::ACCEPTED());

    expect(EloquentStoredEvent::query()->count())->toEqual(1);
})->with('strings');
