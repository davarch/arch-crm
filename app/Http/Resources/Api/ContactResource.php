<?php

declare(strict_types=1);

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use TiMacDonald\JsonApi\JsonApiResource;

/**
 * @property string $title
 * @property string $first_name
 * @property string|null $middle_name
 * @property string $last_name
 * @property string $preferred_name
 * @property string $phone
 * @property string $email
 */
final class ContactResource extends JsonApiResource
{
    /**
     * @return array<string, array<string, string>|string>
     */
    public function toAttributes(Request $request): array
    {
        return [
            'title' => $this->title,
            'name' => [
                'first' => $this->first_name,
                'middle' => $this->middle_name ?? '',
                'last' => $this->last_name,
                'preferred' => $this->preferred_name,
                'full' => $this->fullName(),
            ],
            'phone' => $this->phone,
            'email' => $this->email,
        ];
    }

    private function fullName(): string
    {
        $firstName = $this->first_name;
        $middleName = $this->middle_name ?? '';
        $lastName = $this->last_name;

        return ltrim("{$firstName} {$middleName} {$lastName}");
    }
}
