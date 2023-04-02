<?php

declare(strict_types=1);

use App\Models\Interaction;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use JustSteveKing\StatusCode\Http;
use function Pest\Laravel\getJson;

it('receives a 401 on get interactions when not logged in', function (): void {
    getJson(route('api:interactions:index'))
        ->assertStatus(Http::UNAUTHORIZED());
});

it('i can a retrieve a list of interactions', function (): void {
    $user = User::factory()->create();
    auth()->login($user);

    Interaction::factory(10)->create([
        'user_id' => $user->id,
    ]);

    getJson(route('api:interactions:index'))
        ->assertStatus(Http::OK())
        ->assertJson(
            fn (AssertableJson $json) => $json->count(10)->first(
                fn (AssertableJson $json) => $json->where('type', 'interactions')->etc()
            )
        );
});
