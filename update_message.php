<?php
// Habilitar la visualización de errores para depuración (quitar en producción)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtiene los datos de la solicitud POST
    $data = json_decode(file_get_contents('php://input'), true);

    // Verifica si el mensaje del administrador está presente en los datos
    if (isset($data['adminMessage'])) {
        // Prepara el contenido para el archivo JSON
        $newContent = json_encode(['adminMessage' => $data['adminMessage']]);

        // Ruta completa al archivo message.json
        $filePath = 'message.json';

        // Verificar si el archivo existe y es escribible
        if (is_writable($filePath)) {
            // Intenta escribir el nuevo contenido en el archivo JSON
            if (file_put_contents($filePath, $newContent)) {
                echo json_encode(['message' => 'Mensaje actualizado correctamente']);
            } else {
                echo json_encode(['message' => 'Error al escribir en el archivo message.json']);
            }
        } else {
            echo json_encode(['message' => 'El archivo message.json no es escribible o no existe']);
        }
    } else {
        echo json_encode(['message' => 'Mensaje del administrador no proporcionado']);
    }
} else {
    echo json_encode(['message' => 'Solicitud no válida']);
}
?>
