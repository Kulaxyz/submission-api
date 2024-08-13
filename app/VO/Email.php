<?php

namespace App\VO;

use App\Exceptions\InvalidEmail;

final class Email
{
    private const EMAIL_REGEX = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

    private function __construct(public readonly string $value) {
    }

    public static function fromString(string $email): self
    {
        if (!preg_match(self::EMAIL_REGEX, $email)) {
            throw InvalidEmail::from($email);
        }
        return new self($email);
    }
}