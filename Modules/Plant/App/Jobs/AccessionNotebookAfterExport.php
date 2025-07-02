<?php

namespace Modules\Plant\App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AccessionNotebookAfterExport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    protected $path;

    protected $user;

    public function __construct($path, $user)
    {
        $this->path = $path;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to($this->user->email)->send(new \Modules\Plant\App\Emails\AccessionNotebookAfterExport($this->path));
        } catch (\Throwable $th) {
            Log::info('Accession Notebook After Export Error: ', [$th->getMessage()]);
        }
    }
}
