<?php

declare(strict_types=1);

namespace Domains\Contacts\Handlers;

use Domains\Contacts\Actions\CreateNewContact;
use Domains\Contacts\Actions\UpdateContact;
use Domains\Contacts\Events\ContactCreated;
use Domains\Contacts\Events\ContactUpdated;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

final class ContactHandler extends Projector
{
    public function __construct(
        private readonly CreateNewContact $createNewContact,
        private readonly UpdateContact $updateContact,
    ) {
    }

    public function onContactCreated(ContactCreated $event): void
    {
        ($this->createNewContact)($event->data);
    }

    public function onContactUpdated(ContactUpdated $event): void
    {
        ($this->updateContact)($event->uuid, $event->data);
    }
}
