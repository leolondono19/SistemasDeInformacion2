<?php
namespace app\models;

use app\config\db;

class pedidoModel {

    public function guardarPedido($productos, $total) {
        $db = db::conectar(); // Conectar a la base de datos
        $query = $db->prepare("INSERT INTO pedidos (total) VALUES (:total)");
        $query->bindParam(':total', $total, PDO::PARAM_STR);

        if ($query->execute()) {
            $pedidoId = $db->lastInsertId(); // Obtener el ID del pedido insertado

            // Insertar los productos asociados al pedido
            foreach ($productos as $producto) {
                $query = $db->prepare("INSERT INTO pedido_detalle (pedido_id, producto_id, cantidad) VALUES (:pedido_id, :producto_id, :cantidad)");
                $query->bindParam(':pedido_id', $pedidoId, PDO::PARAM_INT);
                $query->bindParam(':producto_id', $producto['id'], PDO::PARAM_INT);
                $query->bindParam(':cantidad', $producto['cantidad'], PDO::PARAM_INT);
                $query->execute();
            }

            return true;
        } else {
            return false;
        }
    }
}
