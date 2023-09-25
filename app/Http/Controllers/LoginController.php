<?php

namespace App\Http\Controllers;

use App\Models\UserResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    /**
     * Realiza una petición al backend para obtener un usuario, si existe, se carga la vista de 
     * formulario, en caso contrario permanece en la pantalla de login.
     * En ambos casos se muestra un mensaje de información.
     */
    public function getUserByDni(Request $request) {
        try {
            $response = Http::get('http://212.225.255.130:8010/ws/accesotec/'.
                        $request->input('userName').'/'.$request->input('dni'));

            if ($response->status() === 200) {
                $data = json_decode(json_encode(simplexml_load_string($response->body())), true);
                $user = new UserResponse();
                $user->userName = $data['Registro']['@attributes']['Nombre'];
                $user->email = $data['Registro']['@attributes']['Email'];
                Alert::success('Éxito', 'Usuario logueado con éxito.');
                return view('formView', compact('user'));
            } else {
                Alert::error('Error', 'El usuario no existe.');
                return view('login');
            }
        } catch (\Exception $e) {
            Alert::error('Error', 'Ocurrió un error.');
        }
    }
}
