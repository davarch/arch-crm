<?php

declare(strict_types=1);

use App\Models\Interaction;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use JustSteveKing\StatusCode\Http;
use function Pest\Laravel\getJson;

it('receives a 401 on get interaction when not logged in', function (): void {
    $interaction = Interaction::factory()->create();

    getJson(route('api:interactions:show', $interaction->uuid))
        ->assertStatus(Http::UNAUTHORIZED());
});

it('receives a 404 on get interaction with incorrect UUID', function (string $uuid, string $string): void {
    auth()->login(User::factory()->create());

    getJson(route('api:interactions:show', $uuid))
        ->assertStatus(Http::NOT_FOUND());

    getJson(route('api:interactions:show', $string))
        ->assertStatus(Http::NOT_FOUND());
})->with('uuids', 'strings');

it('can retrieve a interaction by UUID', function (): void {
    $user = User::factory()->create();
    auth()->login($user);

    $interaction = Interaction::factory()->create([
        'user_id' => $user->id,
    ]);

    getJson(route('api:interactions:show', $interaction->uuid))
        ->assertStatus(Http::OK())
        ->assertJson(
            fn (AssertableJson $json) => $json
                ->where('type', 'interactions')
                ->where('attributes.type', $interaction->type)
                ->where('attributes.contact', $interaction->contact_id)
                ->etc()
        );
});
