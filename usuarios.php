// Función para crear un usuario de prueba
function crearUsuarioTest() {
    $url = API_URL;

    // Datos del usuario de prueba
    $data = [
        'email' => 'test_user_1168650961@testuser.com',
        'nickname' => 'TESTUSER1168650961',
        'password' => 'mdBkimLBmq'
    ];

    $options = [
        'http' => [
            'header'  => [
                "Content-Type: application/json",
                "Authorization: Bearer " . obtenerAccessToken()
            ],
            'method'  => 'POST',
            'content' => json_encode($data),
        ],
    ];

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    
    if ($result === FALSE) {
        die('Error al crear el usuario de prueba');
    }

    // Decodificar la respuesta
    $response = json_decode($result, true);
    
    // Mostrar la respuesta