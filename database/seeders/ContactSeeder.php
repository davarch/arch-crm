<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

final class ContactSeeder extends Seeder
{
    public function run(): void
    {
        Contact::factory(50)->create();
    }
}
