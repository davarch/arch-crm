<?php

declare(strict_types=1);

namespace Domains\Interactions\DataTransferObjects;

use Domains\Interactions\Enums\InteractionType;
use Infrastructure\Contracts\DataTransferObject;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\Validation\Enum;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;

final class InteractionData extends Data implements DataTransferObject
{
    public function __construct(
        #[Enum(InteractionType::class)]
        public readonly string $type,
        #[Exists('contacts', 'id')]
        #[MapOutputName('contact_id')]
        public readonly int $contact,
        #[Exists('users', 'id')]
        #[MapOutputName('user_id')]
        public readonly ?int $user,
        public readonly ?string $content,
        #[Exists('projects', 'id')]
        #[MapOutputName('project_id')]
        public readonly ?int $project,
    ) {
    }
}
