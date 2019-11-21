<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Group;
use Faker\Generator as Faker;

$factory->define(Group::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'code' => $faker->uuid,
        'client' => $faker->name,
        'location' => $faker->city,
        'dated' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'uploaded_by' => 1,
        'scouted_by' => $faker->name,
        'spec_tag' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'spec_tag_parsed' => "",
    ];
});
