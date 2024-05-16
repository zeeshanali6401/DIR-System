<?php

namespace Database\Factories;

use App\Models\DIR;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DIR>
 */
class DIRFactory extends Factory
{
    protected $model = DIR::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'team' => $this->faker->randomElement(['A', 'B', 'C']),
            'shift' => $this->faker->randomElement(['Morning', 'Afternoon', 'Night']),
            'division' => $this->faker->randomElement(['City', 'Iqbal Town', 'Model Town', 'Sader']),
            'ps' => $this->faker->word,
            'case_nature' => $this->faker->word,
            'case_date' => $this->faker->dateTimeThisYear()->format('Y-m-d'),
            'time' => $this->faker->time(),
            'caller_phone' => $this->faker->phoneNumber('+92##########'),
            'case_description' => $this->faker->sentence,
            'location' => $this->faker->word,
            'camera_id' => $this->faker->randomNumber(4, true),
            'evidence' => $this->faker->text,
            'finding_remarks' => $this->faker->boolean,
            'pco_names' => $this->faker->name,
            'images' => $this->faker->text,

        ];
    }
}
