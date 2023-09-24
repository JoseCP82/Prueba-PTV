<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\Technician;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Mail;

class FormViewController extends Controller {

    public function saveFormData(Request $request) {
        $user = new Technician();
        $user->userName = $request->input('userName');
        $user->email = $request->input('email');
        $user->firm = $request->input('imagenFirma');

        try {
            $user->save();
            Alert::success('Éxito', 'Información guardada con éxito.');
        } catch(\Exception $e) {
            Alert::error('Error', 'Ocurrió un error en guardado.');
        }
        
        $this->pdfGenerator($user);
        $this->sendPDFMail();

        $user->userName = "";
        $user->email = "";
        $user->firm = "";
        return view('/formView', compact('user'));
    }

    public function pdfGenerator(Technician $user) {
        $pdf = new Dompdf();

        $html = '<h2>Usuarios</h2>'.
        $html = '<p>'. $user->userName . '</p>'.
        $html = '<p>'. $user->email . '</p>'.
        $html = '<p>'. $user->firm . '</p>';

        try {
            $pdf->loadHtml($html);
            $pdf->render();
            Alert::success('Éxito', 'Archivo pdf descargado con éxito.');
            return $pdf->stream('usuarios.pdf');
        } catch(\Exception $e) {
            Alert::error('Error', 'Ocurrió un error al generar el archivo PDF.');
        }
    }

    public function sendPDFMail() {
        $mail = new SendMail();
        Mail::to('josecamarap@gmail.com')->send($mail);

        return 'Correo enviado con PDF adjunto.';
    }
}