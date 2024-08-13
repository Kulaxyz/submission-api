<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmissionRequest;
use App\Jobs\StoreSubmission;
use App\VO\Email;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

final class SubmissionController
{
    public function store(SubmissionRequest $request): JsonResponse
    {
        $email = Email::fromString($request->string('email'));
        $name = $request->string('name');
        $message = $request->string('message');

        try {
            StoreSubmission::dispatch(
                email: $email,
                name: $name,
                message: $message
            );
        } catch (\Exception $e) {
            Log::error('Submission not stored: ' . $e->getMessage(), $e->getTrace());

            return response()->json(['message' => 'Submission not stored'], 500);
        }

        return response()->json(['message' => 'Submission stored']);
    }
}