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
    // Obtener registros de sitio_inspeccion solamente por ahora
    // Ya que las otras tablas no tienen relación directa
    $sql = "SELECT 
                id,
                tipositioInspeccion,
                entidad,
                sitio,
                fecha,
                hora
            FROM sitio_inspeccion 
            ORDER BY fecha DESC, id DESC
            LIMIT 100"; // Limitar a los últimos 100 registros
    
    $resultado = $conexion->query($sql);
    
    $records = [];
    while ($fila = $resultado->fetch_assoc()) {
        // Formatear los datos para mostrar
        $records[] = [
            'id' => $fila['id'],
            'fecha' => $fila['fecha'],
            'sitio' => $fila['sitio'],
            'mercancia' => 'N/A', // Por ahora mostrar N/A hasta que tengamos la relación
            'estadoOrigen' => 'N/A',
            'estadoDestino' => 'N/A',
            'tipo' => $fila['tipositioInspeccion'],
            'entidad' => $fila['entidad'],
            'hora' => $fila['hora']
        ];
    }
    
    echo json_encode([
        'success' => true,
        'records' => $records
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al obtener registros: ' . $e->getMessage()
    ]);
}

$conexion->close();
?>