<?php

use Faker\Generator as Faker;

$factory->define(App\Rating::class, function (Faker $faker) {
	$name=$faker->randomElement(['Sons Bakery','Julia Hotel','Cafe De Capo','One Cafe','Engine Block','Bread Masters','Fuego Grill']);
	
	$user_id = rand(1,100);
    $restaurant_id = rand(1,100);

	$receiver = $faker->randomElement([0,1,2,3,4,5,5,4,3,4,5]);
	$seat_capacity=rand(20,200);
    return [
        //
        
        
        'rating' => $receiver,
        'user_id'=>$user_id,
        'restaurant_id'=>$restaurant_id,
               
        
    ];
});
