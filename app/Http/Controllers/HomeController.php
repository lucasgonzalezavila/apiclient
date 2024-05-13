<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

class HomeController extends Controller{
    public function index(Request $request){
        // Obtén el token de autenticación de la sesión
        $token = $request->session()->get('token');
    
        // Realiza la solicitud HTTP con el token de autenticación
        $response = Http::withToken($token)->get(env('APP_URL') . '/api/libros');
    
        // Verifica si la solicitud fue exitosa
        if ($response->successful()) {
            // Obtén los datos de la respuesta en formato JSON
            $libros = $response->json();
    
            // Pasar los datos a la vista
            return view('welcome', ['libros' => $libros]);
        } else {
            // Si la solicitud no fue exitosa, maneja el error apropiadamente
            return back()->withErrors(['error' => 'Error al obtener los libros']);
        }
    }
}
