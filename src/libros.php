<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>6. Gestión de Libros</title>
</head>
<body>
    <h2>Gestión de Libros con POO</h2>
    <?php
    namespace Libros;
    class Libro
    {
        private $titulo;
        private $autor;
        private $anio_publicacion;
        private $numero_paginas;

        // Métodos para establecer (setters)
        public function setTitulo($titulo)
        {
            $this->titulo = $titulo;
        }
        public function setAutor($autor)
        {
            $this->autor = $autor;
        }
        public function setAnioPublicacion($anio)
        {
            $this->anio_publicacion = $anio;
        }
        public function setNumeroPaginas($paginas)
        {
            $this->numero_paginas = $paginas;
        }

        // Métodos para obtener (getters)
        public function getTitulo()
        {
            return $this->titulo;
        }
        public function getAutor()
        {
            return $this->autor;
        }
        public function getAnioPublicacion()
        {
            return $this->anio_publicacion;
        }
        public function getNumeroPaginas()
        {
            return $this->numero_paginas;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $titulo = $_POST['titulo'] ?? '';
        $autor = $_POST['autor'] ?? '';
        $anio = $_POST['anio'] ?? '';
        $paginas = $_POST['paginas'] ?? '';

        // Validar que estén completos
        if (empty($titulo) || empty($autor) || empty($anio) || empty($paginas)) {
            echo "<p style='color:red;'>Todos los campos son obligatorios.</p>";
        }
        // Asegurarse de que año y páginas sean numéricos
        elseif (!is_numeric($anio) || !is_numeric($paginas)) {
            echo "<p style='color:red;'>El año de publicación y el número de páginas deben ser valores numéricos.</p>";
        } else {
            // Crear instancia de la clase Libro y asignar valores
            $libro = new Libro();
            $libro->setTitulo($titulo);
            $libro->setAutor($autor);
            $libro->setAnioPublicacion($anio);
            $libro->setNumeroPaginas($paginas);

            // Mostrar resumen
            echo "<div style='background-color:#f0f0f0; padding:10px;'>";
            echo "<h3>Resumen del Libro:</h3>";
            echo "<strong>Título:</strong> " . htmlspecialchars($libro->getTitulo()) . "<br>";
            echo "<strong>Autor:</strong> " . htmlspecialchars($libro->getAutor()) . "<br>";
            echo "<strong>Año de publicación:</strong> " . htmlspecialchars($libro->getAnioPublicacion()) . "<br>";
            echo "<strong>Número de páginas:</strong> " . htmlspecialchars($libro->getNumeroPaginas()) . "<br>";
            echo "</div><br>";
        }
    }
    ?>
    <form method="POST" action="">
        Título: <input type="text" name="titulo"><br><br>
        Autor: <input type="text" name="autor"><br><br>
        Año de publicación: <input type="text" name="anio"><br><br>
        Número de páginas: <input type="text" name="paginas"><br><br>
        <button type="submit">Guardar Libro</button>
    </form>
</body>
</html>
