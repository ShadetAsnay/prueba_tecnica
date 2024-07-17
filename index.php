<?php
require_once conexion.php;


echo "Hola Mundo";
define('API_URL', 'https://api.mercadolibre.com/users/test_users');
define('CLIENT_ID', '3674396325623205');
define('CLIENT_SECRET', '2FbCGVzG5ng63kX2bJnEcEBu9EetRPGJ');
define('REDIRECT_URI', 'https://midominio.free.nf'); // Cambia esto por tu URI

// Verifica si hay un código de autorización en la URL
if (isset($_GET['code'])) {
    $authorizationCode = $_GET['code'];
    $token = getAccessToken($authorizationCode);
    echo "Token de acceso: " . $token['access_token'];
} else {
    echo "No se recibió ningún código de autorización.";
}

// Función para obtener el token de acceso
function getAccessToken($authorizationCode) {
    $url = 'https://api.mercadolibre.com/oauth/token';
    $data = [
        'grant_type' => 'authorization_code',
        'client_id' => CLIENT_ID,
        'client_secret' => CLIENT_SECRET,
        'redirect_uri' => REDIRECT_URI,
        'code' => $authorizationCode,
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
        die('Error al obtener el token de acceso');
    }

    return json_decode($result, true);
}

// Crear conexión a la base de datos
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Función para crear un usuario de prueba
function crearUsuarioTest($tipo) {
    $url = API_URL;

    // Datos del usuario de prueba
    $data = [
        'email' => 'test_user_1168650961'.$tipo.'@testuser.com',
        'nickname' => 'TESTUSER1168650961'. strtoupper($tipo),
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
  }
  // Crear un usuario vendedor
crearUsuarioTest('vendedor');

// Crear un usuario comprador
crearUsuarioTest('comprador');

// Función para guardar el usuario en la base de datos
function guardarUsuario($nombre, $email, $tipo) {
    global $conn;
    
    $stmt = $conn->prepare("INSERT INTO usuarios (id, email, tipo) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $email, $tipo);

    if ($stmt->execute()) {
        echo "Usuario guardado en la base de datos: " . $nombre . "<br>";
    } else {
        echo "Error al guardar el usuario: " . $stmt->error . "<br>";
    }

    $stmt->close();
}
// Cerrar conexión
$conn->close();
?>