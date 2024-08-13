<?php

namespace App\Jobs;

use App\Events\SubmissionSaved;
use App\Models\Submission;
use App\VO\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

/**
 * @method static static dispatch(Email $email, string $name, string $message)
 */
class StoreSubmission implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly Email $email,
        private readonly string $name,
        private readonly string $message
    ) {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $submission = Submission::new(email: $this->email, name:  $this->name, message: $this->message);

            event(new SubmissionSaved($submission));
        } catch (\Exception $e) {
            Log::error('Submission not stored: ' . $e->getMessage(), $e->getTrace());
        }
    }
}
