<?php
include ('../resources/config.php'); 

// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prueba_tecnica";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa a la base de datos<br>";
} catch (PDOException $e) {
    echo 'Error de conexión a la base de datos: ' . $e->getMessage();
    exit(); 
}

// Configuración del acceso token de MercadoLibre
$accessToken = 'APP_USR-3449599491479218-071722-9028ff96114ed735c704f3eda3f58e34-1907090654';

// Datos de los productos a publicar
$productos = [
    [
        "title" => "Item de test - No Ofertar",
        "category_id" => "MLU446796",
        "price" => 1350,
        "currency_id" => "UYU",
        "available_quantity" => 10,
        "buying_mode" => "buy_it_now",
        "condition" => "new",
        "listing_type_id" => "gold_special",
        "sale_terms" => [
            [
                "id" => "WARRANTY_TYPE",
                "value_name" => "Garantía del vendedor"
            ],
            [
                "id" => "WARRANTY_TIME",
                "value_name" => "90 días"
            ]
        ],
        "pictures" => [
            [
                "source" => "http://example.com/picture1.jpg"
            ]
        ],
        "attributes" => [
            [
                "id" => "BRAND",
                "value_name" => "Marca del producto 2"
            ],
            [
                "id" => "MODEL",
                "value_name" => "Modelo 1"
            ],
            [
                "id" => "MODELO", 
                "value_name" => "Modelo del producto"
            ]
        ]
    ],

    [
        "title" => "Item de test - No Ofertar",
        "category_id" => "MLU446796",
        "price" => 1050,
        "currency_id" => "UYU",
        "available_quantity" => 5,
        "buying_mode" => "buy_it_now",
        "condition" => "new",
        "listing_type_id" => "gold_special",
        "sale_terms" => [
            [
                "id" => "WARRANTY_TYPE",
                "value_name" => "Garantía del vendedor"
            ],
            [
                "id" => "WARRANTY_TIME",
                "value_name" => "90 días"
            ]
        ],
        "pictures" => [
            [
                "source" => "http://example.com/picture2.jpg"
            ]
        ],
        "attributes" => [
            [
                "id" => "BRAND",
                "value_name" => "Marca del producto 2"
            ],
            [
                "id" => "MODEL",
                "value_name" => "Modelo 2"
            ],
            [
                "id" => "MODELO", 
                "value_name" => "Modelo del producto"
            ]
        ]
     ]
       
];

// Función para publicar un producto en MercadoLibre
function publicarProducto($producto, $accessToken) {
    global $conn;

    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, "https://api.mercadolibre.com/items?access_token=$accessToken");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($producto));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Accept: application/json'
    ]);
    
    $response = curl_exec($ch);
    
    if (curl_errno($ch)) {
        echo 'Error al publicar el producto en MercadoLibre: ' . curl_error($ch);
    } else {
        echo 'Respuesta de la API para el producto: ' . $response . "<br>";
    }

    //Respuesta JSON
    $productoPublicado = json_decode($response, true);

    // Guardar el producto publicado en BD
    guardarProducto($productoPublicado);
    
    curl_close($ch);
}

// Función para guardar un producto en BD
function guardarProducto($producto) {
    global $pdo;

    $stmt = $pdo->prepare("INSERT INTO productos (producto_id, titulo, categoria_id, precio, cantidad_disponible, estado) VALUES (?, ?, ?, ?, ?, ?)");

    // Valores del producto para insertar en BD
    $productoId = $producto['id'];
    $titulo = $producto['title'];
    $categoriaId = $producto['category_id'];
    $precio = $producto['price'];
    $cantidadDisponible = $producto['available_quantity'];
    $estado = $producto['condition'];

    $stmt->execute([$productoId, $titulo, $categoriaId, $precio, $cantidadDisponible, $estado]);
}

// Publicar cada producto en MercadoLibre y guardarlos en BD
foreach ($productos as $producto) {
    publicarProducto($producto, $accessToken);
}
?>
