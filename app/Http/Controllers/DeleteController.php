<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function destroy($id)
    {
        // URL de la API del otro proyecto para borrar un libro
        $apiUrl = 'http://127.0.0.1:8001/api/libros/' . $id;

        // Realizar una solicitud DELETE a la API
        $response = Http::delete($apiUrl);

        // Verificar si la solicitud fue exitosa
        if ($response->successful()) {
            // Redirigir a alguna página o mostrar un mensaje de éxito
            return redirect()->back()->with('success', 'El libro ha sido borrado exitosamente');
        } else {
            // Manejar el caso de que la solicitud no sea exitosa
            return redirect()->back()->with('error', 'Hubo un error al borrar el libro');
        }
    }
}
