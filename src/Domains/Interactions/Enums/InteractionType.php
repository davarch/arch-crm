<?php

declare(strict_types=1);

namespace Domains\Interactions\Enums;

enum InteractionType: string
{
    case Phone = 'phone';
    case Email = 'email';
    case Meeting = 'meeting';
}
