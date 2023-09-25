<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\Technician;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Mail;

class FormViewController extends Controller {

    /**
     * Recoge la información del formulario, la guarda en la base de datos local, genera un archivo
     * pdf, envia un email con el pdf adjunto y setea el formulario.
     */
    public function saveFormData(Request $request) {
        $user = new Technician();
        $user->userName = $request->input('userName');
        $user->email = $request->input('email');
        $user->firm = $request->input('imgFirm');

        try {
            $user->save();
            Alert::success('Éxito', 'Información enviada con éxito.');
        } catch(\Exception $e) {
            Alert::error('Error', 'Ocurrió un error en guardado.');
        }
        
        $this->pdfGenerator($user);
        // $this->sendPDFMail();

        $user->userName = "";
        $user->email = "";
        $user->firm = "";
        return view('/formView', compact('user'));
    }

    /**
     * Genera un archivo pdf con los datos obtenidos en el formulario.
     */
    public function pdfGenerator(Technician $user) {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $pdf = new Dompdf($options);

        $html = '<h2>Usuarios</h2>'.
        $html = '<p>'. $user->userName . '</p>'.
        $html = '<p>'. $user->email . '</p>'.
        $html = '<img src="'. $user->firm . '" alt="Firma">';

        try {
            $pdf->loadHTML($html);
            $pdf->render();

            $pdfOutputPath = storage_path('app/html_to_pdf.pdf');

            // Guarda el PDF en el sistema de archivos
            file_put_contents($pdfOutputPath, $pdf->output());

            $this->sendPDFMail($pdfOutputPath, $html);

            // $pdf->stream('usuarios.pdf'); //Descarga el archivo pdf en la carpeta descargas
            // Alert::success('Éxito', 'Archivo pdf descargado con éxito.');
        } catch(\Exception $e) {
            Alert::error('Error', 'Ocurrió un error al generar el archivo PDF.');
        }
    }

    /**
     * Envia un email a la dirección establecida adjuntando un fichero pdf.
     */
    public function sendPDFMail(string $pdfPath, string $htmlContent) {
        $mail = new SendMail($pdfPath, $htmlContent);
        Mail::to('josecamarap@gmail.com')->send($mail);
    }
}