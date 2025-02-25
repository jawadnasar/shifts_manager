<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Mailer_Send_Email_Template extends Mailable
{
    use Queueable, SerializesModels;
    public $email_body;
    public $email_subject;
    public $email_footer;

    /**
     * Create a new message instance.
     */
    public function __construct($em_subject, $em_body, $em_footer)
    {
        $this->email_body = $em_body;
        $this->email_subject = $em_subject;
        $this->email_footer = $em_footer;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->email_subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            // view: 'admin.email_template_preview',
            // view: $this->email_body
            // view: 'admin.email_template_preview_send',
            view: 'admin.email_template_send',
            with: ['email_body' => $this->email_body, 'email_footer'=>$this->email_footer]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
