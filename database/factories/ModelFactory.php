<?php

use App\User;
use App\Event;
use App\Stand;
use App\Bookin;
use App\Company;
use Illuminate\Support\random;

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

/**
 * User Factory
 *
 */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    return [
    'name' => $faker->name,
    'email' => $faker->unique()->safeEmail,
    'password' => $password ?: $password = bcrypt('secret'),
    'remember_token' => str_random(10),
    ];
});

/**
 * Company Factory
 *
 */
$factory->define(Company::class, function (Faker\Generator $faker) {


    return [
    'name' => $faker->company,
    'admin' => $faker->randomElement([Company::ADMIN_COMPANY, Company::REGULAR_COMPANY]),
    'logo_url' => $faker->randomElement(['default_logo_1.png', 'default_logo_2.png']),
    ];
});

/**
 * Event Factory
 *
 */
$factory->define(Event::class, function (Faker\Generator $faker) {

    return [
    'name' => $faker->sentence(3),
    'location' => $faker->address(),
    'description' => $faker->paragraph(1),
    'start_date' => date("Y-m-d H:i:s", rand(strtotime("+60 days"),strtotime("+70 days"))),
    'end_date' => date("Y-m-d H:i:s", rand(strtotime("+80 days"),strtotime("+90 days"))),
    'photo_url' => $faker->randomElement(['default_envent_1.png', 'default_event_2.png']),  
    ];
});

/**
 * Stands Factory
 *
 */
$factory->define(Stand::class, function (Faker\Generator $faker) {

    return [
    'event_id' => Event::all()->random()->id,
    'name' => $faker->sentence(2) . " Stand",
    'description' => $faker->paragraph(1),
    'price' => $faker->randomFloat(2, $min = 500, $max = 10000),
    'dimensions' => $faker->randomNumber(4),
    'photo_url' => $faker->randomElement(['default_stand_1.png', 'default_stand_2.png']),          
    'status' => Stand::AVAILABLE_STAND,
    ];
});

/**
 * Bookins Factory
 *
 */
$factory->define(Bookin::class, function (Faker\Generator $faker) {

	// Get a random available stand
	$stand = Stand::where('status', Stand::AVAILABLE_STAND)->get()->random();
    $stand->status = Stand::UNAVAILABLE_STAND;
    $stand->save();
    $user = User::doesntHave('bookins')->get()->random();

    return [
    'user_id' => $user->id,
    'event_id' => $stand->event->id,
    'stand_id' => $stand->id,
    'price' => $stand->price
    ];
});
