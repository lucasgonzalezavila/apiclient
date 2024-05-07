<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LibroController extends Controller{
    public function show($id) {
        $response = Http::get(env('APP_URL') . '/api/libros/');

        $libros = $response->json();
        
        return view('libro', ['libros' => $libros[$id-1]]);
    }
}
