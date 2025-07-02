<?php

namespace Modules\Plant\App\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccessionNotebookAfterImport extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->view('plant::Emails.accessionNotebookAfterImport')
            ->subject('Aksesyon Defteri İçe Aktarma Tamamlandı');
    }
}
