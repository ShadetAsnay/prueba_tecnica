<?php
// Datos de conexión a la base de datos
$host = 'localhost';
$dbname = 'prueba_tecnica';
$username = 'root';
$password = '';

try { 
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Conexión exitosa";
    
} catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
    exit(); 
}
?>
