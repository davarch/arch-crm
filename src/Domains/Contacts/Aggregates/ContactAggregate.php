<?php

declare(strict_types=1);

namespace Domains\Contacts\Aggregates;

use Domains\Contacts\DataTransferObjects\ContactData;
use Domains\Contacts\Events\ContactCreated;
use Domains\Contacts\Events\ContactUpdated;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

final class ContactAggregate extends AggregateRoot
{
    public function createContact(ContactData $data): self
    {
        $this->recordThat(
            domainEvent: new ContactCreated(
                data: $data
            )
        );

        return $this;
    }

    public function updateContact(string $uuid, ContactData $data): self
    {
        $this->recordThat(
            domainEvent: new ContactUpdated(
                uuid: $uuid,
                data: $data
            )
        );

        return $this;
    }
}
