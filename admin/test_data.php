<?php
require "../../login/conexion.php";

echo "<h2>Verificación de datos en la base de datos</h2>";

// Verificar tabla usuarios
$resultado = $conexion->query("SELECT COUNT(*) as total FROM usuarios");
$total_usuarios = $resultado->fetch_assoc()['total'];
echo "<p>Total usuarios: " . $total_usuarios . "</p>";

// Verificar tabla sitio_inspeccion
$resultado = $conexion->query("SELECT COUNT(*) as total FROM sitio_inspeccion");
$total_sitios = $resultado->fetch_assoc()['total'];
echo "<p>Total registros sitio_inspeccion: " . $total_sitios . "</p>";

// Verificar tabla info_general
$resultado = $conexion->query("SELECT COUNT(*) as total FROM info_general");
$total_general = $resultado->fetch_assoc()['total'];
echo "<p>Total registros info_general: " . $total_general . "</p>";

// Verificar tabla info_mercancia
$resultado = $conexion->query("SELECT COUNT(*) as total FROM info_mercancia");
$total_mercancia = $resultado->fetch_assoc()['total'];
echo "<p>Total registros info_mercancia: " . $total_mercancia . "</p>";

// Mostrar algunos registros de sitio_inspeccion si existen
if ($total_sitios > 0) {
    echo "<h3>Últimos registros de sitio_inspeccion:</h3>";
    $resultado = $conexion->query("SELECT * FROM sitio_inspeccion ORDER BY id DESC LIMIT 5");
    while ($fila = $resultado->fetch_assoc()) {
        echo "<p>ID: " . $fila['id'] . " - Sitio: " . $fila['sitio'] . " - Fecha: " . $fila['fecha'] . "</p>";
    }
} else {
    echo "<p style='color: red;'>No hay registros en sitio_inspeccion. Esto explica por qué no se muestran datos en el dashboard.</p>";
    echo "<p>Para probar el dashboard, necesitas enviar al menos un formulario desde la página principal.</p>";
}

$conexion->close();
?>