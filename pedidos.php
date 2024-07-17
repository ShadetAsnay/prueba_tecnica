<?php
require_once 'config.php';

function listPedidos($vendedorId) {
    $conn = getDBConnection();
    $sql = "SELECT * FROM pedidos INNER JOIN productos ON pedidos.producto_id = producto.id WHERE productos.seller_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $vendedorId);
    $stmt->execute();
    $result = $stmt->get_result();

    $orders = [];
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
    $stmt->close();
    $conn->close();

    return $orders;
}
?>
