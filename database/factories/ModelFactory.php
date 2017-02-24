<?php

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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\News::class, function (Faker\Generator $faker) {
   return [
       'author_id' => 1,
       'title' => $faker->sentence(mt_rand(3, 10)),
       'lead' => $faker->paragraph,
       'content' => join("\n\n", $faker->paragraphs(mt_rand(3, 5))),
       'image_id' => '148795465858b062e2c37d9',
   ];
});

$factory->define(App\TeamMember::class, function (Faker\Generator $faker) {
   return [
       'first_name' => $faker->firstName,
       'last_name' => $faker->lastName,
       'date_of_birth' => $faker->date('Y-m-d', '-10 years')
   ];
});
