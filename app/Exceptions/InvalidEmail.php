<?php

namespace App\Exceptions;

final class InvalidEmail extends \InvalidArgumentException
{
    public static function from(string $email): self
    {
        return new self(sprintf('Invalid email address: %s', $email));
    }
}