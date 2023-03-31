<?php

declare(strict_types=1);

namespace Domains\Contacts\Events;

use Domains\Contacts\DataTransferObjects\ContactData;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

final class ContactUpdated extends ShouldBeStored
{
    public function __construct(
        public readonly string $uuid,
        public readonly ContactData $data
    ) {
    }
}
