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
    $stats = [];
    
    // Total de usuarios
    $resultado = $conexion->query("SELECT COUNT(*) as total FROM usuarios");
    $stats['totalUsers'] = $resultado->fetch_assoc()['total'];
    
    // Registros de hoy (usando sitio_inspeccion como referencia principal)
    $resultado = $conexion->query("SELECT COUNT(*) as total FROM sitio_inspeccion WHERE DATE(fecha) = CURDATE()");
    $stats['recordsToday'] = $resultado->fetch_assoc()['total'];
    
    // Registros de este mes
    $resultado = $conexion->query("SELECT COUNT(*) as total FROM sitio_inspeccion WHERE MONTH(fecha) = MONTH(CURDATE()) AND YEAR(fecha) = YEAR(CURDATE())");
    $stats['recordsMonth'] = $resultado->fetch_assoc()['total'];
    
    // Total de registros
    $resultado = $conexion->query("SELECT COUNT(*) as total FROM sitio_inspeccion");
    $stats['totalRecords'] = $resultado->fetch_assoc()['total'];
    
    echo json_encode([
        'success' => true,
        'stats' => $stats
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al obtener estadísticas: ' . $e->getMessage()
    ]);
}

$conexion->close();
?>