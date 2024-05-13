<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LibroController extends Controller{
    public function show($id) {
        $response = Http::get(env('APP_URL') . '/api/libros/');

        $libros = $response->json();
        
        return view('libro', ['libros' => $libros["id"=== $id]]);
    }
    public function destroy($id){
        $response = Http::delete(env('APP_URL') . '/api/libros/delete/' . $id);
    
        if ($response->successful()) {
            return redirect()->back()->with('success', 'El libro ha sido borrado exitosamente');
        } else {
            return redirect()->back()->with('error', 'Hubo un error al borrar el libro');
        }
    }
    
}
