<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class Notification extends Mailable
{
    use Queueable, SerializesModels;

    
    
     
    public function __construct(private $msgDetails, public $filename)
    {
      
    }

   
    public function envelope()
    {
        return new Envelope(
            subject: 'Contact Form Mail Notification',
        );
    }

    public function content()
    {
        return new Content(
            view: 'mail.test-email',
            with: ['details' => $this->msgDetails],
        );
    }

    public function attachments()
    {
        return [
            Attachment::fromPath($this->filename),
        ];
    }
}
