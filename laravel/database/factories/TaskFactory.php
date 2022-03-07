<?php

namespace Database\Factories;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'task_status_id' => TaskStatus::inRandomOrder()->first(),
            'user_id' => User::inRandomOrder()->first(),
            'title' => $this->faker->word(),
            'text' => $this->faker->text() . $this->faker->text() . $this->faker->text(),
        ];
    }
}
