<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pdfPath;
    public $html;

    public function __construct($pdfPath, $html)
    {
        $this->pdfPath = $pdfPath;
        $this->html = $html;
    }

    /**
     * Crea encabezado y cuerpo del email, así como adjunta un fichero pdf para su envío.
     */
    public function build()
    {
        $htmlContent = "
            <!DOCTYPE html>
            <html>
            <head>
                <title>Correo con PDF Adjunto</title>
            </head>
            <body>
                <h3>Fichero PDF firmado adjunto.</h3>
            </body>
            </html>
        ";

        return $this
            ->subject('Adjunto de PDF')
            ->attach($this->pdfPath, ['as' => 'usuarios.pdf', 'html_to_pdf.pdf'])
            ->html($htmlContent);
    }
}
