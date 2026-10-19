<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>1. Registro Básico</title>
</head>
<body>
    <h2>Formulario de Registro Básico</h2>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST['nombre'] ?? '';
        $apellido = $_POST['apellido'] ?? '';
        $email = $_POST['email'] ?? '';
        $fecha = $_POST['fecha'] ?? '';

        $errores = [];

        // Validar que todos los campos estén completos
        if (empty($nombre) || empty($apellido) || empty($email) || empty($fecha)) {
            $errores[] = "Todos los campos son obligatorios.";
        }

        // Validar formato del correo
        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores[] = "El formato del correo electrónico no es válido.";
        }

        // Verificar que la fecha sea válida y mayor de 18 años
        if (!empty($fecha)) {
            $fechaNacimiento = DateTime::createFromFormat('Y-m-d', $fecha);
            if (!$fechaNacimiento || $fechaNacimiento->format('Y-m-d') !== $fecha) {
                $errores[] = "La fecha de nacimiento no es válida.";
            } else {
                $hoy = new DateTime();
                $edad = $hoy->diff($fechaNacimiento)->y;
                if ($edad < 18) {
                    $errores[] = "Debes tener al menos 18 años.";
                }
            }
        }

        // Si todo es correcto, muestra la información proporcionada
        if (empty($errores)) {
            echo "<h3 style='color:green;'>Información proporcionada:</h3>";
            echo "Nombre: " . htmlspecialchars($nombre) . "<br>";
            echo "Apellido: " . htmlspecialchars($apellido) . "<br>";
            echo "Email: " . htmlspecialchars($email) . "<br>";
            echo "Fecha de nacimiento: " . htmlspecialchars($fecha) . "<br><br>";
        } else {
            echo "<ul style='color:red;'>";
            foreach ($errores as $error) { echo "<li>$error</li>"; }
            echo "</ul>";
        }
    }
    ?>
    <form method="POST" action="">
        Nombre: <input type="text" name="nombre"><br><br>
        Apellido: <input type="text" name="apellido"><br><br>
        Email: <input type="text" name="email"><br><br>
        Fecha de nacimiento: <input type="date" name="fecha"><br><br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
