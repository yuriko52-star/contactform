<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => $this->faker->numberBetween(1,5),
            'first_name' =>$this->faker->lastName() ,
            'last_name' => $this->faker->firstName(),
            'gender' => $this->faker->numberBetween(1,3),
            'email' =>  $this->faker->safeEmail(),
            'tel' => $this->faker->phoneNumber(),
            'address' => $this->faker->city() . $this->faker->streetAddress(),
            // ランダムな都市名とランダムな住所をドットを使って結合、1つの文字列を作る
            'building' => $this->faker->secondaryAddress(),
            'detail' => $this->faker->text(100)
            // 日本語化したいときは、config/app.phpを変更'faker_locale' => 'ja_JP',そのあとphp artisan config:clear
            // モデルにインポートとuse HasFactoryが必要

        ];
    }
}
