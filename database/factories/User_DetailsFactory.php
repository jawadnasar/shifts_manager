<?php

namespace Database\Factories;

use App\Models\User_Details;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User_Details>
 */
class User_DetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = User_Details::class;
    
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10000),
            'dob' => $this->faker->dateTimeBetween('-80 years', '-18 years')->format('Y-m-d'),
            'gender' => $this->faker->randomElement(['m', 'f', 'o']),
            'phone' => $this->faker->phoneNumber,
            // 'birth_place' => $this->faker->city,
            // 'nationality' => $this->faker->country, // Random country name
            // 'current_address' => $this->faker->address, // Random address
            // 'town' => $this->faker->city, // Random city name
            // 'postcode' => $this->faker->postcode, // Random postal code
            // 'living_since' => $this->faker->date('Y-m-d', 'now'), // Random date up to today
            // 'ni_number' => $this->faker->regexify('[A-Z]{2}[0-9]{6}[A-Z]{1}'), // Random National Insurance number
            // 'emergency_contact_name' => $this->faker->name, // Random name
            // 'emergency_contact_relationship' => $this->faker->randomElement(['Parent', 'Sibling', 'Friend', 'Spouse']), // Random relationship
            // 'emergency_contact_phone' => $this->faker->phoneNumber, // Random phone number
            // 'sia_licence_type' => $this->faker->randomElement(['Security Guard', 'Door Supervisor', 'CCTV']), // Random licence type
            // 'sia_licence_number' => $this->faker->numerify('SIA-######'), // Random licence number
            // 'sia_licence_expiry_date' => $this->faker->dateTimeBetween('now', '+5 years')->format('Y-m-d'), // Expiry date in the future
            // 'driving_licence_present' => $this->faker->boolean, // Random boolean (1 or 0)
            // 'driving_licence_type' => $this->faker->randomElement(['Full', 'Provisional', null]), // Random licence type
            // 'driving_licence_number' => $this->faker->regexify('[A-Z]{5}[0-9]{6}[A-Z]{2}[0-9]{2}'), // Random driving licence number
            // 'own_vehicle' => $this->faker->boolean, // Random boolean (1 or 0)
            // 'criminal_offence_present' => $this->faker->boolean, // Random boolean (1 or 0)
            // 'criminal_offence_details' => $this->faker->optional()->sentence, // Random text or null
            // 'share_code' => $this->faker->uuid, // Random unique identifier
            'created_by' => 1
        ];
    }
}
