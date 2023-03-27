<?php

declare(strict_types=1);

use App\Models\Contact;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use function Pest\Laravel\getJson;
use Symfony\Component\HttpFoundation\Response;

it('i can a retrieve a list of contacts for a user', function () {
    auth()->loginUsingId(User::factory()->create()->id);

    Contact::factory(10)->create();

    getJson(route('api:contacts:index'))
        ->assertStatus(Response::HTTP_OK)
        ->assertJson(
            fn (AssertableJson $json) => $json->count(10)->first(
                fn (AssertableJson $json) => $json->where('type', 'contacts')->etc()
            )
        );
});
