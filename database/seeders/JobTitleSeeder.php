<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\JobTitle;
use Illuminate\Database\Seeder;

final class JobTitleSeeder extends Seeder
{
    public function run(): void
    {
        JobTitle::factory(100)->create();
    }
}
