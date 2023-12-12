<?php

function verificarCorreoElectronicoExistente($correoElectronico) {
    // Clave de API
    $apiKey = '4fed95c5ed6d456836ad4412372fe337c4b415d3';

    // URL de la API de Hunter
    $url = "https://api.hunter.io/v2/email-verifier?email={$correoElectronico}&api_key={$apiKey}";

    // Inicializar cURL
    $ch = curl_init($url);

    // Configurar opciones de cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Realizar la solicitud a la API
    $respuesta = curl_exec($ch);

    // Verificar si hubo errores en la solicitud
    if (curl_errno($ch)) {
        echo 'Error al realizar la solicitud: ' . curl_error($ch);
        curl_close($ch);
        return false;
    }

    // Cerrar la sesión cURL
    curl_close($ch);

    // Decodificar la respuesta JSON
    $datos = json_decode($respuesta, true);

    // Verificar si la verificación fue exitosa
    if ($datos['data']['result'] == 'deliverable') {
        return -1; // La dirección de correo electrónico existe
    } else {
        return 0; // La dirección de correo electrónico no existe o no es válida
    }
}

?>
