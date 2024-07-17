<?php
function getAccessToken($clientId, $clientSecret) {
    $url = 'https://api.mercadolibre.com/oauth/token';
    $data = [
        'grant_type' => 'client_credentials',
        'client_id' =>3674396325623205,
        'client_secret' => '2FbCGVzG5ng63kX2bJnEcEBu9EetRPGJ',
    ];

    $options = [
        'http' => [
            'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ],
    ];

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    
    if ($result === FALSE) {
        // Muestra el error
        echo "Error al obtener el token de acceso: ";
        var_dump($http_response_header); // Muestra la cabecera de respuesta HTTP
        return false;
    }

    return json_decode($result, true);
}


/*function createUser($accessToken, $email, $tipo) {
    $url = 'https://api.mercadolibre.com/users';
    $data = [
        'email' => $email,
        'password' => 'test123', // Usa una contraseña adecuada
    ];

    $options = [
        'http' => [
            'header'  => "Content-Type: application/json\r\n" .
                         "Authorization: Bearer $accessToken\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
        ],
    ];

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    
    if ($result === FALSE) {
        die('Error al crear el usuario');
    }

    return json_decode($result, true);
}*/
?>
