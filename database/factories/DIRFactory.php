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
            'case_id' => $this->faker->regexify('LHR-\d{8}-\d{7}'),
            'team' => $this->faker->randomElement(['A', 'B', 'C']),
            'gang_name' => $this->faker->randomElement(['Chotu Gang', 'Khalid Chitta', 'Shahid Lamba']),
            'shift' => $this->faker->randomElement(['Morning', 'Afternoon', 'Night']),
            'cro' => $this->faker->randomElement(['yes', 'no']),
            'face_trace' => $this->faker->randomElement(['yes', 'no']),
            'anpr_passing' => $this->faker->randomElement(['yes', 'no']),
            'division' => $this->faker->randomElement(['City', 'Civil_lines', 'iqbal_town', 'model_town', 'cantt', 'sader']),
            'ps' => $this->faker->word,
            'fir_number' => $this->faker->randomNumber(4, true),
            'culprit' => $this->faker->randomElement(['yes', 'no']),
            'case_nature' => $this->faker->randomElement(['Traffic Offence', 'Local & Special Laws', 'Crime Against Person', 'Crime Against Property']),
            'case_date_time' => now(),
            'caller_phone' => '+92' . substr($this->faker->numerify('##########'), 0, 10),
            'case_description' => $this->faker->sentence,
            'location' => $this->faker->city('us'),
            'camera_id' => $this->faker->randomNumber(4, true),
            'evidence' => $this->faker->text,
            'finding_remarks' => $this->faker->boolean,
            'pco_names' => $this->faker->name,
            'images' => $this->faker->text,
            'feedback' => $this->faker->randomElement(['pending', 'good', 'bad', 'important', 'not important']),
            'user_id' => 1,
            'user_ip' => $this->faker->ipv4,
            'user_hostname' => $this->faker->domainName,
            'user_email' => $this->faker->email,

        ];
    }
}
