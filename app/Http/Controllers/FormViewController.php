<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\User_request;
use Illuminate\Http\Request;
use Dompdf\Dompdf;

class FormViewController extends Controller {

    public function saveFormData(Request $request) {
        $user = new User_request();
        $user->userName = $request->input('userName');
        $user->email = $request->input('email');
        // $user->save();

        $this->pdfGenerator($user);

        // return redirect('/formView')->with('mensaje', 'Datos guardados correctamente');
    }

    public function pdfGenerator(User_request $user) {
        $pdf = new Dompdf();

        $html = '<h2>Usuarios</h2>'.
        $html = '<p>'. $user->userName . '</p>'.
        $html = '<p>'. $user->email . '</p>';

        $pdf->loadHtml($html);

        $pdf->render();

        return $pdf->stream('usuarios.pdf');
    }
}