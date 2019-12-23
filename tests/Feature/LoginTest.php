<?php

namespace Tests\Feature\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_WrongCredentials(){
        //Create user
        User::create([
            'name' => 'nibri10',
            'email'=>'nibri10@gmail.com',
            'password' => bcrypt('123456')
        ]);
        //Login Test wrong credentials
        $response = $this->call('POST','api/login',[
            'email' => 'nibri10@gmail.com',
            'password' => '12346',
        ]);
        $response->assertStatus(401)
            ->assertJson([
                'status' => 'error',
                'message'=> 'We can`t find an account with this credentials.'
            ]);
        //Delete the user
        User::where('email','nibri10@gmail.com')->delete();
    }
    public function test_Login(){

        //Create user
        User::create([
            'name' => 'nibri10',
            'email'=>'nibri10@gmail.com',
            'password' => bcrypt('123456')
        ]);
        //Login Test
        $response = $this->json('POST','api/login',[
            'email' => 'nibri10@gmail.com',
            'password' => '123456',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'data'=>[

                ]
            ]);
        //Delete the user
        User::where('email','nibri10@gmail.com')->delete();

    }
}
