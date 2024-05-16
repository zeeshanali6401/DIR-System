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
            'division' => $this->faker->randomElement(['City', 'Civil_lines', 'iqbal_town', 'model_town', 'cantt', 'sader']),
            'ps' => $this->faker->word,
            'case_nature' => $this->faker->randomElement(['Traffic Offence', 'Local & Special Laws', 'Crime Against Person', 'Crime Against Property']),
            'case_date' => $this->faker->dateTimeThisYear()->format('Y-m-d'),
            'time' => $this->faker->time(),
            'caller_phone' => '+92' . substr($this->faker->numerify('##########'), 0, 10),
            'case_description' => $this->faker->sentence,
            'location' => $this->faker->city('us'),
            'camera_id' => $this->faker->randomNumber(4, true),
            'evidence' => $this->faker->text,
            'finding_remarks' => $this->faker->boolean,
            'pco_names' => $this->faker->name,
            'images' => $this->faker->text,

        ];
    }
}
