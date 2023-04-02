<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Interaction;
use Illuminate\Database\Seeder;

final class InteractionSeeder extends Seeder
{
    public function run(): void
    {
        Interaction::factory(100)->create();
    }
}
