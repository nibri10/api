<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;


class PostTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    protected function authenticate(){
        $user = User::create([
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'password' => Hash::make('secret1234'),
        ]);
        $this->user = $user;
        $token = JWTAuth::fromUser($user);
        return $token;
    }

    public function test_GetAllPostWithUser(){
        $token = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('GET','api/posts');
        $response->assertStatus(200);

    }

    public function test_CreatePost(){
        $token = $this->authenticate();

        $response = $this->withHeaders([
           'Authorization' => 'Bearer '. $token,
       ])->postJson('api/posts',[
           'title' => $this->faker->title,
           'description' => $this->faker->text,
           'category'=>$this->faker->text
       ]);
        $response->assertStatus(200);
    }

    public function test_SinglePost(){
        $token = $this->authenticate();
        //create User for the new post
        $user = factory(User::class)->create();

        $post = Post::create([
            'title' => $this->faker->title,
            'description' => $this->faker->text,
            'category'=>$this->faker->text,
            'user_id'=>$user->id,
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('GET','api/posts',['id' => $post->id]);
        $response->assertStatus(200);
    }

    public function test_SingleUpdatePost(){

        $token = $this->authenticate();

        //create User for the new post
        $user = factory(User::class)->create();
        $post = Post::create([
            'title' => $this->faker->title,
            'description' => $this->faker->text,
            'category'=>$this->faker->text,
            'user_id'=>$user->id,
        ]);

        $response =  $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json( 'PUT', route('posts.update', $post->id),  [
            'title' => $this->faker->title,
            'description' => $this->faker->text,
            'category'=>$this->faker->text,
            'user_id'=>$user->id,
        ]);


        $response->assertStatus(200);

    }

    public function test_DeletePost(){

        $token = $this->authenticate();

        //create User for the new post
        $user = factory(User::class)->create();
        $post = Post::create([
            'title' => $this->faker->title,
            'description' => $this->faker->text,
            'category'=>$this->faker->text,
            'user_id'=>$user->id,
        ]);
        $response =  $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->deleteJson( 'api/posts/'.$post->id);

        $response->assertStatus(200);

    }

}
