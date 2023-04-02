<?php

declare(strict_types=1);

use Illuminate\Support\Str;

dataset('uuids', static function () {
    yield Str::uuid()->toString();
    yield Str::uuid()->toString();
    yield Str::uuid()->toString();
});
