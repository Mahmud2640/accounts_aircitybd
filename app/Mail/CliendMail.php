<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CliendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $array;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($array)
    {
        $this->array = $array;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.client')
                     ->from($this->array['from'])

                    ->attach($this->array['passport_copy'],[
                        'as' => $this->array['passport_copy'],
                        'mime' => 'application/image'
                    ])
                    ->attach($this->array['ticket_copy'],[
                        'as' => $this->array['ticket_copy'],
                        'mime' => 'application/image'
                    ])
                    ->attach($this->array['visa_copy'],[
                        'as' => $this->array['visa_copy'],
                        'mime' => 'application/image'
                    ])
                    ->attach($this->array['others_copy'],[
                        'as' => $this->array['others_copy'],
                        'mime' => 'application/image'
                    ])

                    ->subject($this->array['subject']);
    }
}
