<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtiene los datos de la solicitud POST
    $data = json_decode(file_get_contents('php://input'), true);

    // Verifica si el mensaje del administrador está presente en los datos
    if (isset($data['adminMessage'])) {
        // Prepara el contenido para el archivo JSON
        $newContent = json_encode(['adminMessage' => $data['adminMessage']]);

        // Intenta escribir el nuevo contenido en el archivo JSON
        if (file_put_contents('message.json', $newContent)) {
            echo json_encode(['message' => 'Mensaje actualizado correctamente']);
        } else {
            echo json_encode(['message' => 'Error al actualizar el mensaje']);
        }
    } else {
        echo json_encode(['message' => 'Mensaje del administrador no proporcionado']);
    }
} else {
    echo json_encode(['message' => 'Solicitud no válida']);
}
?>
