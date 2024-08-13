<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;

final class SubmissionTest extends TestCase
{
    use CreatesApplication, DatabaseMigrations;

    public function testInvalidData(): void
    {
        $payload = [
            'name' => 'John Doe',
            'email' => 'invalid.gmail.com',
            'message' => 'Hello, World!',
        ];

        $response = $this->postJson('/submit', $payload);

        $response->assertStatus(422);

        $response->assertJson([
            'message' => 'Invalid data send',
            'details' => [
                'email' => ['The email field must be a valid email address.'],
            ],
        ]);
    }

    public function testValidData(): void
    {
        $payload = [
            'name' => 'John Doe',
            'email' => 'valid@gmail.com',
            'message' => 'Hello, World!',
        ];

        $response = $this->postJson('/submit', $payload);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Submission stored',
        ]);
    }
}