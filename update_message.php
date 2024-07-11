<?php
// Permitir acceso desde cualquier origen (CORS)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Verificar si la solicitud es mediante POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del cuerpo de la solicitud
    $data = json_decode(file_get_contents('php://input'), true);

    // Solo para depuración: devolver los datos recibidos
    echo json_encode($data);
} else {
    http_response_code(405); // Método no permitido
    echo json_encode(['message' => 'Método no permitido']);
}
?>
