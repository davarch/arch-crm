<?php

declare(strict_types=1);

use App\Models\Contact;
use App\Models\Project;
use App\Models\User;
use Domains\Interactions\Enums\InteractionType;
use JustSteveKing\StatusCode\Http;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;
use Spatie\EventSourcing\StoredEvents\Models\EloquentStoredEvent;

it('receives a 401 on create interaction when not logged in', function (string $string): void {
    getJson(
        route('api:interactions:store'),
        [
            'type' => InteractionType::Meeting->value,
            'contact' => Contact::factory()->create()->id,
            'content' => $string,
            'project' => Project::factory()->create()->id,
        ]
    )
        ->assertStatus(Http::UNAUTHORIZED());
})->with('strings');

it('can create a new interaction', function (string $string): void {
    auth()->login(User::factory()->create());

    expect(EloquentStoredEvent::query()->count())->toEqual(0);

    postJson(
        route('api:interactions:store'),
        [
            'type' => InteractionType::Meeting->value,
            'contact' => Contact::factory()->create()->id,
            'content' => $string,
            'project' => Project::factory()->create()->id,
        ]
    )
        ->assertStatus(Http::ACCEPTED());

    expect(EloquentStoredEvent::query()->count())->toEqual(1);
})->with('strings');
