<?php
// Habilitar la visualización de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require "conexion.php"; // Usar require para detener la ejecución si la conexión falla

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validar que los campos no estén vacíos
    if (empty(trim($_POST["username"])) || empty($_POST["user_password"])) {
        $mensaje = "❌ Por favor, ingresa usuario y contraseña.";
    } else {
        $identificador = trim($_POST["username"]); // Puede ser username o email
        $contrasena_ingresada = $_POST["user_password"];

        // Preparar la consulta para buscar por username o email
        $stmt = $conexion->prepare("SELECT username, user_email, user_password, tipo_usuario FROM usuarios WHERE username = ? OR user_email = ?");
        $stmt->bind_param("ss", $identificador, $identificador);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();
            $hash_guardado = $usuario["user_password"];

            // Verificar la contraseña
            if (password_verify($contrasena_ingresada, $hash_guardado)) {
                // Iniciar sesión
                $_SESSION["username"] = $usuario["username"];
                $_SESSION["tipo_usuario"] = $usuario["tipo_usuario"];

                // Redirigir según el tipo de usuario
                if ($usuario["tipo_usuario"] === 'administrador') {
                    header("Location: ../admin/dashboard.html"); // Redirigir a un dashboard de admin
                } else {
                    header("Location: ../form/index.html"); // Redirigir al formulario principal
                }
                exit();
            } else {
                $mensaje = "❌ Contraseña incorrecta.";
            }
        } else {
            $mensaje = "❌ Usuario no encontrado.";
        }
        $stmt->close();
    }
}
// Cierra la conexión solo si no es una solicitud POST, o si lo es y ya terminó.
if (isset($conexion)) {
    $conexion->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <img src="../img/Logo-cesavenay.png" id="logo-cesavenay" alt="Logo Cesavenay">
            <h1>BIENVENIDO AL SISTEMA DE REGISTRO</h1>
            <p>Por favor, ingresa tu usuario y contraseña para acceder</p>
        </div>

        <?php if (!empty($mensaje)): ?>
            <div class="error-message"><?php echo $mensaje; ?></div>
        <?php endif; ?>

        <form id="loginForm" action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Nombre de usuario o Email</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="user_password">Contraseña</label>
                <div class="password-toggle">
                    <input type="password" id="user_password" name="user_password" required>
                    <button type="button" class="toggle-btn" onclick="togglePassword()" aria-label="Mostrar/Ocultar contraseña">👁️</button>
                </div>
            </div>
            <div class="remember-forgot">
                <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>
            </div>
            <button type="submit" class="login-btn">Iniciar Sesión</button>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>