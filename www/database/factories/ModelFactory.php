<?php

use App\User;
use App\Models\{
    Category,
    Customer,
    Product,
    Order
};
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(Category::class, function (Faker $faker) : array {
    return [
        'name' => $faker->unique()->word(),
        'description' => $faker->paragraph($nbSentences = 3),
    ];
});


$factory->define(Product::class, function (Faker $faker) : array {
    return [
        CreateUsersTable::FOREIGN_KEY => User::all()->random()->{CreateUsersTable::PRIMARY_KEY},
        CreateCategoriesTable::FOREIGN_KEY => Category::all()->random()->{CreateCategoriesTable::PRIMARY_KEY},
        'title' => $faker->sentence($nbwords = 3),
        'content' => $faker->paragraph($nbSentences = rand(1, 10)),
        'pictures' => $faker->imageUrl($width = 640, $height = 480),
        'price' => $faker->biasedNumberBetween($min = 10, $max = 20, $function = 'sqrt'),
        'btw' => 0.21,
        'sale' => $faker->biasedNumberBetween($min = 0, $max = 1, $function = 'sqrt'),
        'stock' => $faker->boolean(),
    ];
});

$factory->define(User::class, function (Faker $faker) : array {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => Hash::make($faker->password($minLength = 6, $maxLength = 20)),
        'remember_token' => str_random(10),
        'given_name' => $faker->firstName,
        'family_name' => $faker->lastName,
    ];
});

$factory->define(Customer::class, function (Faker $faker) : array {
    return [
        'user_name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => Hash::make($faker->password($minLength = 6, $maxLength = 20)),
        'remember_token' => str_random(10),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
    ];
});

