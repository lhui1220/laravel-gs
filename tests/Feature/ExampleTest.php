<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/api/interview/ucfirst',['X-Token'=>'token-xxxx']);

        $response->assertStatus(200)
                    ->assertHeader('X-token','token-xxx');
    }
}
