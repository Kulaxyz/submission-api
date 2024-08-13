<?php

namespace Tests\Unit;

use App\Exceptions\InvalidEmail;
use App\VO\Email;
use PHPUnit\Framework\TestCase;

final class EmailTest extends TestCase
{
    public function testInvalidEmail(): void
    {
        $email = 'invalid_email.gmail.com';

        $this->expectException(InvalidEmail::class);

        Email::fromString($email);
    }

    public function testValidEmail(): void
    {
        $email = 'valid_email@gmail.com';

        $emailObject = Email::fromString($email);

        $this->assertSame($email, $emailObject->value);
    }
}