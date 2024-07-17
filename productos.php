<?php
require_once 'config.php';

function listProducts($sellerId) {
    $conn = getDBConnection();
    $sql = "SELECT * FROM productos WHERE comprador_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $sellerId);
    $stmt->execute();
    $result = $stmt->get_result();

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    $stmt->close();
    $conn->close();

    return $products;
}

function addProduct($sellerId, $title, $price, $status) {
    $conn = getDBConnection();
    $sql = "INSERT INTO productos (seller_id, title, price, status) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isds", $sellerId, $title, $price, $status);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}
?>