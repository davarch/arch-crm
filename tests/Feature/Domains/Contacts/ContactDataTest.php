<?php

declare(strict_types=1);

use Domains\Contacts\DataTransferObjects\ContactData;
use Illuminate\Validation\ValidationException;
use function Pest\Laravel\withExceptionHandling;

it('can create a contact data', function (string $string): void {
    expect(ContactData::validateAndCreate([
        'title' => $string,
        'name' => [
            'first' => $string,
            'middle' => $string,
            'last' => $string,
            'preferred' => $string,
        ],
        'phone' => $string,
        'email' => "$string@email.com",
    ]))->toBeInstanceOf(ContactData::class)
    ->title->toEqual($string)
    ->firstName->toEqual($string);
})->with('strings');

it('dont create a contact data with validation', function (string $string): void {
    withExceptionHandling()
        ->expectException(ValidationException::class);

    ContactData::validateAndCreate([
        'title' => $string,
        'name' => [
            'middle' => $string,
            'last' => $string,
            'preferred' => $string,
        ],
        'phone' => $string,
        'email' => "$string@email.com",
    ]);
})->with('strings');
