<?php

namespace Database\Factories;

use App\Models\AcademicYear;
use App\Models\Grade;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'year_id' => AcademicYear::factory(),
            'grade_id' => Grade::factory(),
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'gender' => $this->faker->randomElement(['L', 'P']),
            'birth_place' => $this->faker->city(),
            'birth_date' => $this->faker->date(),
            'address' => $this->faker->address(),
            'father_name' => $this->faker->name(),
            'status' => $this->faker->randomElement([1, 0]),
            'created_by' => $this->faker->name(),
        ];
    }
}
