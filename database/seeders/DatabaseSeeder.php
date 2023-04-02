<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (! app()->isLocal()) {
            return;
        }

        $this->call([
            UserSeeder::class,
            ContactSeeder::class,
            CompanySeeder::class,
            DepartmentSeeder::class,
            TeamSeeder::class,
            JobTitleSeeder::class,
            ProjectSeeder::class,
            InteractionSeeder::class,
        ]);
    }
}
