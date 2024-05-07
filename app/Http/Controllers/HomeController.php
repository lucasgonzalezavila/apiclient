<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

class HomeController extends Controller{
    public function index(){
        $response = Http::get(env('APP_URL') . '/api/libros');

        // Obtener los datos de la respuesta en formato JSON
        $libros = $response->json();

        // Pasar los datos a la vista
        return view('welcome', ['libros' => $libros]);
    }
}
