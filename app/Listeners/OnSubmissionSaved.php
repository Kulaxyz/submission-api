<?php

namespace App\Listeners;

use App\Events\SubmissionSaved;
use Illuminate\Support\Facades\Log;

class OnSubmissionSaved
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        if (!$event instanceof SubmissionSaved) {
            throw new \InvalidArgumentException('Invalid event');
        }

        Log::info('Submission saved', [
            'email' => $event->submission->email,
            'name' => $event->submission->name,
        ]);
    }
}
