<?php

declare(strict_types=1);

use App\Models\Contact;
use App\Models\Project;
use App\Models\User;
use Domains\Interactions\DataTransferObjects\InteractionData;
use Domains\Interactions\Enums\InteractionType;
use Illuminate\Validation\ValidationException;
use function Pest\Laravel\withExceptionHandling;

it('can create a interaction data', function (string $string): void {
    expect(InteractionData::validateAndCreate([
        'type' => InteractionType::Meeting->value,
        'contact' => Contact::factory()->create()->id,
        'user' => User::factory()->create()->id,
        'project' => Project::factory()->create()->id,
        'content' => $string,
    ]))->toBeInstanceOf(InteractionData::class)
        ->type->toEqual(InteractionType::Meeting->value)
        ->content->toEqual($string);
})->with('strings');

it('dont create a interaction data with validation', function (int $integer): void {
    withExceptionHandling()
        ->expectException(ValidationException::class);

    InteractionData::validateAndCreate([
        'type' => InteractionType::Meeting->value,
        'contact' => $integer,
        'user' => $integer,
        'project' => $integer,
    ]);
})->with('integers');
