<?php

namespace Modules\Plant\App\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccessionNotebookImportFail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    protected $errors;

    public function __construct($errors)
    {
        $this->errors = $errors;
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->view('plant::Emails.accessionNotebookImportFail', [
            'errors' => $this->errors,
        ])->subject('İçe Aktarma İşleminde Hata Oluştu');
    }
}
