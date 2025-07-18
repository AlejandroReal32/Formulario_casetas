<?php
session_start();
require "../../login/conexion.php";

// Verificar que el usuario esté logueado y sea administrador
if (!isset($_SESSION['username']) || $_SESSION['tipo_usuario'] !== 'administrador') {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Acceso denegado']);
    exit();
}

// Obtener datos JSON
$input = json_decode(file_get_contents('php://input'), true);

try {
    // Validar datos requeridos
    $required_fields = ['nombre', 'apellido_paterno', 'username', 'email', 'password', 'tipo_usuario'];
    foreach ($required_fields as $field) {
        if (empty($input[$field])) {
            throw new Exception("El campo {$field} es requerido");
        }
    }
    
    // Verificar que no exista el username o email
    $stmt = $conexion->prepare("SELECT id FROM usuarios WHERE username = ? OR user_email = ?");
    $stmt->bind_param("ss", $input['username'], $input['email']);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($resultado->num_rows > 0) {
        throw new Exception("El nombre de usuario o email ya existe");
    }
    
    // Hash de la contraseña
    $password_hash = password_hash($input['password'], PASSWORD_DEFAULT);
    
    // Insertar nuevo usuario
    $apellido_materno = $input['apellido_materno'] ?? '';
    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, apellido_paterno, apellido_materno, username, user_email, user_password, tipo_usuario) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", 
        $input['nombre'], 
        $input['apellido_paterno'], 
        $apellido_materno, 
        $input['username'], 
        $input['email'], 
        $password_hash, 
        $input['tipo_usuario']
    );
    
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Usuario agregado exitosamente',
            'user_id' => $conexion->insert_id
        ]);
    } else {
        throw new Exception("Error al insertar usuario: " . $stmt->error);
    }
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

$conexion->close();
?>