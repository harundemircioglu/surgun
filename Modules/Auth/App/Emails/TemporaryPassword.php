<?php

namespace Modules\Auth\App\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TemporaryPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    protected $password;

    public function __construct($password)
    {
        $this->password = $password;
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->view('auth::Emails.temporaryPassword', [
            'password' => $this->password
        ])->subject('Hesabınız Oluşturuldu!');
    }
}
