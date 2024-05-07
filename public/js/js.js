function buscarLibros() {
    // Obtener valores del formulario
    var titulo = document.getElementById('titulo').value;
    var autor = document.getElementById('autor').value;

    // Construir la URL de la API
    var url = "{{ env('APP_URL') }}/api/libros";

    // Agregar título y autor a la URL si están presentes
    if (titulo) {
        url += "?titulo=" + encodeURIComponent(titulo);
    }
    if (autor) {
        url += "&autor=" + encodeURIComponent(autor);
    }

    // Realizar la solicitud a la API
    fetch(url)
        .then(response => response.json())
        .then(data => {
            // Manipular la respuesta de la API, por ejemplo, mostrar los resultados en la página
            console.log(data); // Esto es solo un ejemplo, puedes hacer lo que necesites con los datos
        })
        .catch(error => {
            console.error('Error al buscar libros:', error);
        });
}