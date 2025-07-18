<?php
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
                    header("Location: ../admin/dashboard.php"); // Redirigir a un dashboard de admin
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
$conexion->close();
?>