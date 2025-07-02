<?php

namespace Modules\Plant\App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AccessionNotebookImportFail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    protected $errors;

    protected $user;

    public function __construct($errors, $user)
    {
        $this->errors = $errors;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to($this->user->email)->send(new \Modules\Plant\App\Emails\AccessionNotebookImportFail($this->errors));
        } catch (\Throwable $th) {
            Log::info('Accesion Notebook Fail Error: ', [$th]);
        }
    }
}
