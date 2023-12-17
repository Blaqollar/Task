<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmailControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_sendEmails_dispatchesJob()
    {
        $response = $this->get('/send-emails');

        $this->assertTrue(
            method_exists($job, 'yourExpectedMethod'),
            'The job should have the expected method.'
        );

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Email job dispatched successfully']);
    }
}
