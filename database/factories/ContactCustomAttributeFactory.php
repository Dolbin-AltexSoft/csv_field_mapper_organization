<?php

namespace Database\Factories;

use App\Models\ContactCustomAttribute;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactCustomAttributeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContactCustomAttribute::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'key' => $this->faker->randomElement(['foo_key', 'bar_key']),
            'value' => $this->faker->randomElement(['foo_value', 'bar_value']),
            'contact_id' => $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
        ];
    }
}
