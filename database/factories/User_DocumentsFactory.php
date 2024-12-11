<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\User_Documents;
use Illuminate\Database\Eloquent\Factories\Factory;

class User_DocumentsFactory extends Factory
{
    protected $model = User_Documents::class;

    public function definition()
    {
        return [
            // 'doc_id' => $this->faker->unique()->randomNumber(8), This is primary key
            'user_id' => User::query()->inRandomOrder()->value('id') ?? User::factory(), // Random existing user or create one
            'doc_type' => $this->faker->randomElement([
                'national_idcard', 
                'security_licence', 
                'driving_licence', 
                'passport', 
                'brp', 
                'other'
            ]), // Random document type
            'link' => $this->faker->url, // Example URL for the document
            'status' => $this->faker->randomElement([1, 2, 3, 4]), // Random status value
            'details' => $this->faker->text(200), // Random descriptive text
            
            'created_by' => User::query()->inRandomOrder()->value('id') ?? User::factory(), // Random existing user or create one,
        ];
    }
}
