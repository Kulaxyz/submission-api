<?php

namespace App\Models;

use App\VO\Email;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $email
 * @property string $name
 * @property string $message
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
final class Submission extends Model
{
    protected $fillable = ['email', 'name', 'message'];

    public static function new(Email $email, string $name, string $message): self
    {
         return self::create([
            'email' => $email->value,
            'name' => $name,
            'message' => $message,
        ]);
    }
}