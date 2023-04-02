<?php

declare(strict_types=1);

use App\Models\Contact;
use App\Models\Interaction;
use App\Models\Project;
use Domains\Interactions\Actions\CreateInteraction;
use Domains\Interactions\Actions\GetInteractionByUuid;
use Domains\Interactions\Actions\UpdateInteraction;
use Domains\Interactions\DataTransferObjects\InteractionData;
use Domains\Interactions\Enums\InteractionType;
use Domains\Interactions\Exceptions\InteractionNotFound;
use Domains\Interactions\Exceptions\InteractionUpdateFailed;
use Illuminate\Contracts\Container\BindingResolutionException;
use function Pest\Laravel\withExceptionHandling;

it('can get a interaction', function (): void {
    $interactionByFactory = Interaction::factory()->create();

    $interaction = (new GetInteractionByUuid())($interactionByFactory->uuid);

    expect($interaction)
        ->toBeInstanceOf(Interaction::class)
        ->and($interaction->getAttribute('type'))->toEqual($interactionByFactory->type)
        ->and($interaction->getAttribute('contact_id'))->toEqual($interactionByFactory->contact_id)
        ->and($interaction->getAttribute('project_id'))->toEqual($interactionByFactory->project_id)
        ->and($interaction->getAttribute('content'))->toEqual($interactionByFactory->content);
});

it("don't get a interaction", function (string $uuid): void {
    withExceptionHandling()
        ->expectException(InteractionNotFound::class);

    withExceptionHandling()
        ->expectExceptionMessage("Interaction Not Found by UUID [{$uuid}]");

    (new GetInteractionByUuid())($uuid);
})->with('uuids');

it('can create a new interaction', function (string $string): void {
    $contact = Contact::factory()->create();
    $project = Project::factory()->create();

    $interaction = (new CreateInteraction())(
        InteractionData::from(
            [
                'type' => InteractionType::Email->value,
                'contact' => $contact->id,
                'content' => $string,
                'project' => $project->id,
            ]
        )
    );

    expect($interaction)
        ->toBeInstanceOf(Interaction::class)
        ->and($interaction->getAttribute('type'))->toEqual(InteractionType::Email->value)
        ->and($interaction->getAttribute('contact_id'))->toEqual($contact->id)
        ->and($interaction->getAttribute('project_id'))->toEqual($project->id)
        ->and($interaction->getAttribute('content'))->toEqual($string);
})->with('strings');

it('can update a interaction', /** @throws BindingResolutionException */ function (string $string): void {
    $contact = Contact::factory()->create();
    $project = Project::factory()->create();
    $interaction = Interaction::factory()->create();

    $data = InteractionData::from(
        [
            'type' => InteractionType::Email->value,
            'contact' => $contact->id,
            'content' => $string,
            'project' => $project->id,
        ]
    );

    $updateInteraction = app()->make(UpdateInteraction::class);
    $updateInteraction($interaction->uuid, $data);

    expect($interaction->refresh())
        ->toBeInstanceOf(Interaction::class)
        ->and($interaction->getAttribute('type'))->toEqual(InteractionType::Email->value)
        ->and($interaction->getAttribute('contact_id'))->toEqual($contact->id)
        ->and($interaction->getAttribute('project_id'))->toEqual($project->id)
        ->and($interaction->getAttribute('content'))->toEqual($string);
})->with('strings');

it("don't update a interaction", /** @throws BindingResolutionException */ function (string $uuid): void {
    withExceptionHandling()
        ->expectException(InteractionUpdateFailed::class);

    withExceptionHandling()
        ->expectExceptionMessage("Failed to update a interaction with UUID [{$uuid}]");

    $data = InteractionData::from(
        [
            'type' => InteractionType::Email->value,
            'contact' => Contact::factory()->create()->id,
            'content' => $uuid,
            'project' => Project::factory()->create()->id,
        ]
    );

    $updateInteraction = app()->make(UpdateInteraction::class);
    $updateInteraction($uuid, $data);
})->with('uuids');
