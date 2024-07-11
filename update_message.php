<?php
// Permitir acceso desde cualquier origen (CORS)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *"); // Permitir todos los encabezados
header("Content-Type: application/json");

// Verificar si la solicitud es mediante POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del cuerpo de la solicitud
    $data = json_decode(file_get_contents('php://input'), true);

    // Verificar si se recibió el mensaje del administrador
    if (isset($data['adminMessage'])) {
        // Preparar el nuevo contenido para el archivo JSON
        $newContent = json_encode(['adminMessage' => $data['adminMessage']]);

        // Ruta al archivo message.json (ajusta la ruta según tu configuración)
        $filePath = 'message.json';

        // Intentar escribir el nuevo contenido en el archivo JSON
        if (file_put_contents($filePath, $newContent)) {
            echo json_encode(['message' => 'Mensaje actualizado correctamente']);
        } else {
            http_response_code(500); // Error interno del servidor
            echo json_encode(['message' => 'Error al escribir en el archivo message.json']);
        }
    } else {
        http_response_code(400); // Solicitud incorrecta
        echo json_encode(['message' => 'Mensaje del administrador no proporcionado']);
    }
} else {
    http_response_code(405); // Método no permitido
    echo json_encode(['message' => 'Método no permitido']);
}
?>
