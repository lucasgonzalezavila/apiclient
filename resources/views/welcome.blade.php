<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body class="antialiased bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
    @if (Route::has('login'))
        <div class="fixed top-0 right-0 p-6 text-right z-10">
            @auth
                <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                @endif
            @endauth
        </div>
    @endif
    <main>
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-semibold text-center my-8">Lista de Libros</h1>
            <div class="flex justify-center my-4">
                <input id="buscarInput" class="border border-gray-300 rounded-md py-2 px-4 w-80" type="text" placeholder="Buscar autor...">
                <button onclick="buscarLibros()" class="ml-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md">Buscar</button>
            </div>
            <div id="listaLibros" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($libros as $libro)
                <a href="/libros/{{$libro['id']}}"><div class="bg-white shadow-lg rounded-lg p-4">
                    <h2 class="text-lg font-semibold mb-2">{{ $libro['titulo'] }}</h2>
                    <p class="text-gray-600 mb-4">Autor: {{ $libro['autor'] }}</p>
                </div></a>
                @endforeach
            </div>
        </div>
    </main>
    <script>
        function buscarLibros() {
        var autor = document.getElementById('buscarInput').value;

        // Construir la URL de la API
        var url = "{{ env('APP_URL') }}/api/libros/" + encodeURIComponent(autor);

        // Realizar la solicitud a la API
        fetch(url)
            .then(response => response.json())
            .then(libros => {
                mostrarLibros(libros);
            })
            .catch(error => {
                console.error('Error al buscar libros:', error);
            });
    }

    // Función para mostrar los libros en la página
    function mostrarLibros(libros) {
        var listaLibros = document.getElementById('listaLibros');
        listaLibros.innerHTML = ''; // Limpiar resultados anteriores

        libros.forEach(libro => {
            var card = document.createElement('div');
            card.classList.add('bg-white', 'shadow-lg', 'rounded-lg', 'p-4');

            var titulo = document.createElement('h2');
            titulo.classList.add('text-lg', 'font-semibold', 'mb-2');
            titulo.textContent = libro.titulo;

            var autor = document.createElement('p');
            autor.classList.add('text-gray-600', 'mb-4');
            autor.textContent = 'Autor: ' + libro.autor;

            var descripcion = document.createElement('p');
            descripcion.classList.add('text-gray-700');
            descripcion.textContent = libro.descripcion;

            card.appendChild(titulo);
            card.appendChild(autor);
            card.appendChild(descripcion);

            listaLibros.appendChild(card);
        });
    }

    // Escuchar el evento keypress en el campo de búsqueda para buscar al presionar Enter
    document.getElementById('buscarInput').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            buscarLibros();
        }
    });
    </script>
</body>
</html>
