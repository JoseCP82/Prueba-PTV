<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
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

    public function build()
    {
        $htmlContent = "
            <!DOCTYPE html>
            <html>
            <head>
                <title>Correo con PDF Adjunto</title>
            </head>
            <body>
                <h1>¡Hola!</h1>
                <p>Fichero PDF adjunto.</p>
            </body>
            </html>
        ";

        return $this
            ->subject('Adjunto de PDF')
            ->html($htmlContent)
            ->attach('c:\Users\Jose\Downloads\usuarios.pdf');
    }
}
