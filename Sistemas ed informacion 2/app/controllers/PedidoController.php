<?php
// app/controllers/PedidoController.php

namespace app\controllers;

use app\models\mainModel;
use PDO; // Asegúrate de que PDO esté en el espacio de nombres global

// Incluye el archivo server.php desde la carpeta config
if(file_exists(__DIR__ . "/../../config/server.php")) {
    require_once __DIR__ . "/../../config/server.php";
} else {
    die("Error: No se encontró el archivo de configuración.");
}


class PedidoController extends mainModel {

    private $db;

    // Constructor que inicializa la conexión a la base de datos
    public function __construct() {
        try {
            $dsn = "mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            $this->db = new PDO($dsn, DB_USER, DB_PASS);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Error de conexión: ' . $e->getMessage();
            die();
        }
    }

    // Obtener todos los pedidos
    public function obtenerPedidos() {
        $query = $this->db->prepare("SELECT * FROM pedido ORDER BY fecha DESC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un pedido por su código
    public function obtenerPedidoPorCodigo($codigo_pedido) {
        $query = $this->db->prepare("SELECT * FROM pedido WHERE codigo_pedido = :codigo_pedido");
        $query->bindParam(':codigo_pedido', $codigo_pedido);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Obtener el detalle de un pedido
    public function obtenerDetallePedido($codigo_pedido) {
        $query = $this->db->prepare("SELECT * FROM detalle_pedido WHERE codigo_pedido = :codigo_pedido");
        $query->bindParam(':codigo_pedido', $codigo_pedido);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Cambiar el estado de un pedido
    public function cambiarEstadoPedido($codigo_pedido, $nuevo_estado) {
        $query = $this->db->prepare("UPDATE pedido SET estado = :estado WHERE codigo_pedido = :codigo_pedido");
        $query->bindParam(':estado', $nuevo_estado);
        $query->bindParam(':codigo_pedido', $codigo_pedido);
        return $query->execute();
    }
}
