<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

final class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        Department::factory(20)->create();
    }
}
