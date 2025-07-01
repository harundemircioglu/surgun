<?php

namespace Modules\Plant\App\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccessionNotebookAfterExport extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    protected $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->view('plant::Emails.accessionNotebookAfterExport', [
            'path' => $this->path,
        ])->subject('Dışa Aktarılan Aksesyon Defteri');
    }
}
