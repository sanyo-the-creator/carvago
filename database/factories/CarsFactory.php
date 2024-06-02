<?php

namespace Database\Factories;

use App\Models\Cars;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cars>
 */
class CarsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cars::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $carModels = [
            'Bentley Continental GT', 'Aston Martin DB11', 'Rolls-Royce Phantom', 'Ferrari 488 GTB',
            'Lamborghini Huracan', 'Porsche 911 Turbo', 'Maserati Ghibli', 'Jaguar F-Type',
            'Mercedes-Benz S-Class', 'BMW 7 Series', 'Audi A8', 'Tesla Model S Plaid',
            'Lexus LS', 'Alfa Romeo Giulia Quadrifoglio', 'Cadillac CT6', 'Genesis G90',
            'Land Rover Range Rover', 'McLaren 720S', 'Bugatti Chiron', 'Pagani Huayra'
        ];

        return [
            'carModel' => $this->faker->randomElement($carModels),
            'tags' => implode(', ', $this->faker->words(3)),
            'src' => $this->faker->imageUrl(640, 480, 'cars', true),
            'available' => $this->faker->boolean(),
            'description' => $this->faker->sentence(20),
            'rental_price_per_day' => $this->faker->randomFloat(2, 20, 200),
            'user_id' => User::inRandomOrder()->first()->id,
            'location' => $this->faker->city()
        ];
    }
}
