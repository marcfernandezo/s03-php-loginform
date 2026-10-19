<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>8. Subida de Archivos</title>
</head>
<body>
    <h2>Subida de Imagen</h2>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == UPLOAD_ERR_OK) {

            $nombreArchivo = $_FILES['archivo']['name'];
            $tamanoArchivo = $_FILES['archivo']['size'];
            $rutaTemporal = $_FILES['archivo']['tmp_name'];

            $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
            $extensionesValidas = ['jpg', 'png', 'gif'];
            $tamanoMaximo = 2 * 1024 * 1024; // 2MB

            // Verificar tamaño máximo
            if ($tamanoArchivo > $tamanoMaximo) {
                echo "<p style='color:red;'>Error: El archivo supera el tamaño máximo permitido de 2MB.</p>";
            }
            // Verificar tipo de imagen
            elseif (!in_array($extension, $extensionesValidas)) {
                echo "<p style='color:red;'>Error: Solo se permiten archivos de tipo JPG, PNG o GIF.</p>";
            } else {
                // Almacenar en el directorio "uploads"
                $directorio = 'uploads/';
                if (!is_dir($directorio)) {
                    mkdir($directorio, 0777, true);
                }

                $rutaDestino = $directorio . basename($nombreArchivo);

                if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
                    echo "<p style='color:green;'>¡Éxito! La imagen se ha subido correctamente.</p>";
                } else {
                    echo "<p style='color:red;'>Hubo un error al guardar la imagen en el servidor.</p>";
                }
            }
        } else {
            echo "<p style='color:red;'>Error en el proceso de subida o no se seleccionó ningún archivo.</p>";
        }
    }
    ?>
    <form method="POST" action="" enctype="multipart/form-data">
        <label>Selecciona una imagen (Max 2MB):</label><br><br>
        <input type="file" name="archivo" required><br><br>
        <button type="submit">Subir Archivo</button>
    </form>
</body>
</html>
