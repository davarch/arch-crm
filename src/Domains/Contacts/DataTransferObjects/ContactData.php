<?php

declare(strict_types=1);

namespace Domains\Contacts\DataTransferObjects;

use Infrastructure\Contracts\DataTransferObject;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Data;

final class ContactData extends Data implements DataTransferObject
{
    public function __construct(
        public readonly ?string $title,
        #[MapInputName('name.first')]
        #[MapOutputName('first_name')]
        public readonly string $firstName,
        #[MapInputName('name.middle')]
        #[MapOutputName('middle_name')]
        public readonly ?string $middleName,
        #[MapInputName('name.last')]
        #[MapOutputName('last_name')]
        public readonly ?string $lastName,
        #[MapInputName('name.preferred')]
        #[MapOutputName('preferred_name')]
        public readonly ?string $preferredName,
        public readonly ?string $phone,
        #[Email(Email::RfcValidation, Email::DnsCheckValidation)]
        public readonly ?string $email,
    ) {
    }
}
