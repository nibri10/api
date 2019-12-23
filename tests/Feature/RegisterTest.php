<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;


    /**
     * Test Register New User with request data empty
     *
     */
    public function test_RequiresEmailAndRegister()
    {
        $response = $this->json('POST', 'api/register');
        $response->assertStatus(200)
            ->assertJson([
                'status'=> "error",
                'message'=> [
                    'name'=>["The name field is required."],
                    'email' => ["The email field is required."],
                    'password' => ["The password field is required."],
                ],

            ]);
    }


    public function test_RegisterNewUser()
    {
        $data = [
            'email' => 'nic@nic.com',
            'name' => 'Test',
            'password' => 'secret1234',

        ];

        $response = $this->json('POST','api/register', $data);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'data'=>[

                ]
            ]);
    }


}
