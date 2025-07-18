<?php
session_start();
require "../../login/conexion.php";

// Verificar que el usuario esté logueado y sea administrador
if (!isset($_SESSION['username']) || $_SESSION['tipo_usuario'] !== 'administrador') {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Acceso denegado']);
    exit();
}

try {
    // Obtener todos los usuarios
    $sql = "SELECT id, nombre, apellido_paterno, apellido_materno, username, user_email, tipo_usuario, created_at FROM usuarios ORDER BY created_at DESC";
    $resultado = $conexion->query($sql);
    
    $users = [];
    while ($fila = $resultado->fetch_assoc()) {
        $users[] = $fila;
    }
    
    echo json_encode([
        'success' => true,
        'users' => $users
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al obtener usuarios: ' . $e->getMessage()
    ]);
}

$conexion->close();
?>