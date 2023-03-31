<?php

declare(strict_types=1);

use App\Models\Contact;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use JustSteveKing\StatusCode\Http;
use function Pest\Laravel\getJson;

it('receives a 401 on get contacts when not logged in', function (): void {
    getJson(route('api:contacts:index'))
        ->assertStatus(Http::UNAUTHORIZED());
});

it('i can a retrieve a list of contacts for a user', function (): void {
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
