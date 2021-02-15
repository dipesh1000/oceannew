<?php

namespace App\Mail;

use App\User;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $code;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$code)
    {
        //
        $this->data = $data;
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('example@example.com')->markdown('emails.customer.welcome-email', [
            'url' => 'http://127.0.0.1:8000/user/activate/',
          
        ]);
    }
}
