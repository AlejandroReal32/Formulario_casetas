<?php
require "conexion.php";

// Datos del usuario administrador
$nombre = "Admin";
$apellido_paterno = "Principal";
$apellido_materno = "Sistema";
$username = "admin";
$email = "admin@cesavenay.com";
$password = "admin123"; // Contraseña que usarás para iniciar sesión
$tipo_usuario = "administrador";

// Generar hash de la contraseña
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Insertar el usuario en la base de datos
$sql = "INSERT INTO usuarios (nombre, apellido_paterno, apellido_materno, username, user_email, user_password, tipo_usuario) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("sssssss", $nombre, $apellido_paterno, $apellido_materno, $username, $email, $password_hash, $tipo_usuario);

if ($stmt->execute()) {
    echo "✅ Usuario administrador creado exitosamente!<br>";
    echo "Usuario: admin<br>";
    echo "Contraseña: admin123<br>";
    echo "Tipo: administrador<br>";
    echo "<br><a href='login.php'>Ir al login</a>";
} else {
    echo "❌ Error al crear usuario: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>