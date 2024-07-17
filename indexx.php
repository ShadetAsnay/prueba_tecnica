<?php
require 'api.php';
require 'productos.php';
require 'pedidos.php';

// Credenciales
$clientId = '5942278354205305';      
$clientSecret = 'Xlk6lO6KrCdQyDd5lowmJB1nO3XQnIBB';

// Obtener el token de acceso
$tokenInfo = getAccessToken($clientId, $clientSecret);
$accessToken = $tokenInfo['access_token'];

// Crear usuarios (vendedor y comprador)
$vendedor = createUser($accessToken, 'vendedor@test.com', 'vendedor');
$comprador = createUser($accessToken, 'comprador@test.com', 'comprador');

// Almacenar en base de datos
$conn = getDBConnection();
$conn->query("INSERT INTO usuarios (email, tipo, access_token) VALUES ('{$vendedor->email}', 'vendedor', '{$accessToken}')");
$conn->query("INSERT INTO usuarios (email, tipo, access_token) VALUES ('{$comprador->email}', 'comprador', '{$accessToken}')");

// Añadir productos (ejemplo)
addProduct(1, 'Producto 1', 100.00, 'active');
addProduct(1, 'Producto 2', 150.00, 'active');

// Listar productos del vendedor
$products = listProducts(1);
echo "Productos del vendedor:\n";
print_r($products);

// Listar órdenes del vendedor (suponiendo que se han realizado compras)
$pedidos = listOrders(1);
echo "Órdenes del vendedor:\n";
print_r($pedidos);