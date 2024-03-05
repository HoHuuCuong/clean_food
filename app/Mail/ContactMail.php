<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;


    public function __construct($data)
    {
        $this->data     = $data;

    }

    public function build()
    {
        return $this->subject('Email từ khách hàng!')
                    ->view('mail.contact', [
                        'data'      =>  $this->data,
                    ]);
    }
}
