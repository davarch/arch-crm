<?php

declare(strict_types=1);

dataset(
    'integers',
/** @throws Exception */ static function () {
        yield random_int(10000, 10000000);
        yield random_int(10000, 10000000);
        yield random_int(10000, 10000000);
    });
