<?php
// Configuración
$accessToken = 'APP_USR-5137806493821739-071813-db350420c42591efbd5825805f6f1a99-1907090842'; 
$productoId = 'MLU687315716'; 
$cantidad = 1; 
$emailComprador = 'test_user_513625702@testuser.com'; 

// Datos de compra
$compraData = [
    "items" => [
        [
            "id" => $productoId,
            "quantity" => $cantidad,
            "unit_price" => 100 
        ]
    ],
    "payer" => [
        "email" => $emailComprador
    ]
];

// Inicializar cURL
$ch = curl_init();

// Configurar cURL para enviar la solicitud POST para crear una preferencia de checkout
curl_setopt($ch, CURLOPT_URL, "https://api.mercadolibre.com/checkout/preferences?access_token=$accessToken");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($compraData));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Accept: application/json'
]);

// Ejecutar la solicitud para crear la preferencia de checkout
$response = curl_exec($ch);

// Verificar errores
if (curl_errno($ch)) {
    echo 'Error al crear la preferencia de checkout: ' . curl_error($ch);
} else {
    
    $responseData = json_decode($response, true);
    
    // Verificar si se creó la preferencia de checkout exitosamente
    if (isset($responseData['id'])) {
        $preferenceId = $responseData['id'];
        
        // Mostrar el ID de la preferencia de checkout (para procesamiento fuera de línea)
        echo 'Se creó la preferencia de checkout correctamente. ID: ' . $preferenceId;
        
        // Guardar el producto en la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "prueba_tecnica";

        try {
            // Crear conexión 
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Insertar producto en BD
            $stmt = $pdo->prepare("INSERT INTO productos_comprados (producto_id, cantidad, email_comprador, preference_id) VALUES (?, ?, ?, ?)");
            
            $stmt->execute([$productoId, $cantidad, $emailComprador, $preferenceId]);
            
            echo "Producto guardado en la base de datos correctamente.";
            
        } catch (PDOException $e) {
            echo 'Error al conectar con la base de datos: ' . $e->getMessage();
        }
    } else {
        echo 'Error al crear la preferencia de checkout';
    }
}

// Cerrar cURL
curl_close($ch);
?>
