<?php
session_start();
// Valores predefinidos según el requisito
$usuarioPredefinido = "admin";
$passwordPredefinido = "12345";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>4. Inicio de Sesión</title>
</head>
<body>
    <h2>Inicio de Sesión</h2>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usuario = $_POST['usuario'] ?? '';
        $password = $_POST['password'] ?? '';

        // Comparar con valores predefinidos
        if ($usuario === $usuarioPredefinido && $password === $passwordPredefinido) {
            // Añadir a $_SESSION un id fijo
            $_SESSION['user_id'] = 999;
            echo "<p style='color:green;'>¡Bienvenido, $usuario! Has iniciado sesión correctamente (ID: " . $_SESSION['user_id'] . ").</p>";
        } else {
            // Mensaje de error y opción de intentarlo de nuevo
            echo "<p style='color:red;'>Error: Usuario o contraseña incorrectos.</p>";
            echo "<a href='login.php'><button>Intentarlo de nuevo</button></a><br><br>";
        }
    }

    if (!isset($_SESSION['user_id']) && $_SERVER["REQUEST_METHOD"] != "POST") {
    ?>
        <form method="POST" action="">
            Nombre de usuario: <input type="text" name="usuario" required><br><br>
            Contraseña: <input type="password" name="password" required><br><br>
            <button type="submit">Iniciar Sesión</button>
        </form>
    <?php
    }
    ?>
</body>
</html>
