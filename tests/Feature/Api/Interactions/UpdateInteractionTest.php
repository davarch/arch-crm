<?php

declare(strict_types=1);

use App\Models\Contact;
use App\Models\interaction;
use App\Models\Project;
use App\Models\User;
use Domains\Interactions\Enums\InteractionType;
use JustSteveKing\StatusCode\Http;
use function Pest\Laravel\getJson;
use function Pest\Laravel\putJson;
use Spatie\EventSourcing\StoredEvents\Models\EloquentStoredEvent;

it('receives a 401 on update interaction when not logged in', function (): void {
    $interaction = Interaction::factory()->create();

    getJson(route('api:interactions:update', $interaction->uuid))
        ->assertStatus(Http::UNAUTHORIZED());
});

it('receives a 404 on update interaction with incorrect UUID', function (string $uuid, string $string): void {
    auth()->login(User::factory()->create());

    getJson(route('api:interactions:update', $uuid))
        ->assertStatus(Http::NOT_FOUND());

    getJson(route('api:interactions:update', $string))
        ->assertStatus(Http::NOT_FOUND());
})->with('uuids', 'strings');

it('can update a interaction', function (string $string): void {
    $user = User::factory()->create();
    auth()->login($user);

    $interaction = Interaction::factory()->create([
        'user_id' => $user->id,
    ]);

    expect(EloquentStoredEvent::query()->count())->toEqual(0);

    putJson(
        route('api:interactions:update', $interaction->uuid),
        [
            'type' => InteractionType::Email->value,
            'contact' => Contact::factory()->create()->id,
            'content' => $string,
            'project' => Project::factory()->create()->id,
        ]
    )->assertStatus(Http::ACCEPTED());

    expect(EloquentStoredEvent::query()->count())->toEqual(1);
})->with('strings');
