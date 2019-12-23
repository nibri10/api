<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory **/
use App\User;
use App\Post;
use Faker\Generator as Faker;


    $factory->define(Post::class, function (Faker $faker) {
    return [
        'title'=>$faker->title,
        'description'=>$faker->text,
        'category'=>$faker->text

    ];
});
