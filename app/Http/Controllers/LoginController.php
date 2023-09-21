<?php

namespace App\Http\Controllers;

use App\Models\UserResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    //
    public function getUserByDni(Request $request) {
        try {
            $response = Http::get('http://212.225.255.130:8010/ws/accesotec/'.
                        $request->input('userName').'/'.$request->input('dni'));

            if ($response->status() === 200) {
                $data = json_decode(json_encode(simplexml_load_string($response->body())), true);
                $user = new UserResponse();
                $user->userName = $data['Registro']['@attributes']['Nombre'];
                $user->email = $data['Registro']['@attributes']['Email'];
                return view('formView', compact('user'));
            } else {
                // Maneja el error de respuesta HTTP de manera apropiada
                // Puedes lanzar una excepción o redirigir a una página de error
            }
        } catch (\Exception $e) {
            // Manejar otras excepciones si ocurren
        }
    }
}
