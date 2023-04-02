<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Interaction;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Interaction>
 */
final class InteractionFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'type' => $this->faker->word(),
            'content' => $this->faker->realText(),
            'contact_id' => Contact::query()->inRandomOrder()->value('id')
                ?? Contact::factory()->create()->id,
            'project_id' => Project::query()->inRandomOrder()->value('id'),
        ];
    }
}
