<?php
// Configuración de la base de datos
$servidor = "localhost";
$usuario_db = "root"; // Usuario por defecto de XAMPP
$contrasena_db = ""; // Contraseña vacía por defecto en XAMPP
$base_datos = "casetas_inspeccion";

// Crear conexión
$conexion = new mysqli($servidor, $usuario_db, $contrasena_db, $base_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Establecer charset UTF-8
$conexion->set_charset("utf8");
?>
