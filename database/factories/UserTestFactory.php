<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserTest;
use Faker\Generator as Faker;

$factory->define(UserTest::class, function (Faker $faker) {

    $ambulances = array('Ambulance_1', 'Ambulance_2', 'Ambulance_3', 'Ambulance_4', 'Ambulance_5');
    $results = array('positive', 'negative');

    $ambulanceID = rand(0, 4);
    $resultID = rand(0, 1);
    $userID = rand(1, 10);
    $covidTestID = rand(1, 2);

    return [
        'ambulance' => $ambulances[$ambulanceID],
        'result' => $results[$resultID],
        'user_id' => $userID,
        'covid_test_id' => $covidTestID
    ];
});
