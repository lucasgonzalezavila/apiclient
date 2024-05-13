<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalles del Libro</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="antialiased">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-semibold text-center my-8">Detalles del Libro</h1>
        <div class="bg-white shadow-lg rounded-lg p-4">
            <h2 class="text-lg font-semibold mb-2">{{ $libros['titulo'] }}</h2>
            <p class="text-gray-600 mb-4">Autor: {{ $libros['autor'] }}</p>
            <p class="text-gray-700">{{ $libros['texto'] }}</p>
            <br>
            <form id="deleteForm" method="POST" action="{{ route('libros.destroy', $libros['id']) }}" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('¿Estás seguro de que quieres borrar este libro?')">DELETE</button>
            </form>
            <br>
            <br>
            <a href="/"><button>BACK</button></a>
        </div>
    </div>
</body>
</html>
