<?php

declare(strict_types=1);

use App\Models\Contact;
use App\Models\Interaction;
use App\Models\Project;
use Domains\Interactions\DataTransferObjects\InteractionData;
use Domains\Interactions\Enums\InteractionType;
use Domains\Interactions\Events\InteractionCreated;
use Domains\Interactions\Events\InteractionUpdated;
use Domains\Interactions\Handlers\InteractionHandler;
use Illuminate\Contracts\Container\BindingResolutionException;

it('can store a new interaction', /** @throws BindingResolutionException */ function (string $string): void {
    $event = new InteractionCreated(
        data: InteractionData::from(
            [
                'type' => InteractionType::Email->value,
                'contact' => Contact::factory()->create()->id,
                'content' => $string,
                'project' => Project::factory()->create()->id,
            ]
        )
    );

    expect($event)->toBeInstanceOf(InteractionCreated::class);

    $handler = app()->make(InteractionHandler::class);
    expect(Interaction::query()->count())->toEqual(0);

    $handler->oninteractionCreated($event);
    expect(Interaction::query()->count())->toEqual(1);
})->with('strings');

it('can update a interaction', /** @throws BindingResolutionException */ function (string $string): void {
    $interaction = Interaction::factory()->create();

    $event = new interactionUpdated(
        uuid: $interaction->uuid,
        data: InteractionData::from(
            [
                'type' => InteractionType::Email->value,
                'contact' => Contact::factory()->create()->id,
                'content' => $string,
                'project' => Project::factory()->create()->id,
            ]
        )
    );

    expect($event)->toBeInstanceOf(InteractionUpdated::class);

    $handler = app()->make(InteractionHandler::class);
    $handler->oninteractionUpdated($event);

    $interaction->refresh();
    expect($interaction->getAttribute('content'))->toEqual($string);
})->with('strings');
