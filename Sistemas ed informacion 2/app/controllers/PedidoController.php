<?php

namespace app\controllers;
use app\models\mainModel;

class PedidoController extends mainModel{

    /*----------  Controlador registrar pedido  ----------*/
    public function registrarPedidoControlador(){

        # Almacenando datos
        $cliente_id = $this->limpiarCadena($_POST['cliente_id']);
        $productos = $_POST['productos']; // array de productos
        $total = $this->limpiarCadena($_POST['total']);

        # Verificando campos obligatorios
        if ($cliente_id == "" || $total == "" || empty($productos)) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error inesperado",
                "texto" => "No has llenado todos los campos que son obligatorios",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }

        # Insertar el pedido
        $pedido_datos_reg = [
            [
                "campo_nombre" => "cliente_id",
                "campo_marcador" => ":ClienteID",
                "campo_valor" => $cliente_id
            ],
            [
                "campo_nombre" => "total",
                "campo_marcador" => ":Total",
                "campo_valor" => $total
            ]
        ];

        $registrar_pedido = $this->guardarDatos("pedido", $pedido_datos_reg);

        if ($registrar_pedido->rowCount() == 1) {
            // Obtener ID del pedido recién registrado
            $pedido_id = $this->ultimoIdInsertado();

            # Registrar productos del pedido
            foreach ($productos as $producto) {
                $producto_datos = [
                    [
                        "campo_nombre" => "pedido_id",
                        "campo_marcador" => ":PedidoID",
                        "campo_valor" => $pedido_id
                    ],
                    [
                        "campo_nombre" => "producto_id",
                        "campo_marcador" => ":ProductoID",
                        "campo_valor" => $producto['id']
                    ],
                    [
                        "campo_nombre" => "cantidad",
                        "campo_marcador" => ":Cantidad",
                        "campo_valor" => $producto['cantidad']
                    ],
                    [
                        "campo_nombre" => "precio",
                        "campo_marcador" => ":Precio",
                        "campo_valor" => $producto['precio']
                    ]
                ];
                $this->guardarDatos("pedido_producto", $producto_datos);
            }

            $alerta = [
                "tipo" => "limpiar",
                "titulo" => "Pedido registrado",
                "texto" => "El pedido ha sido registrado con éxito",
                "icono" => "success"
            ];
        } else {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error inesperado",
                "texto" => "No se pudo registrar el pedido, por favor intente nuevamente",
                "icono" => "error"
            ];
        }

        return json_encode($alerta);
    }

    /*----------  Controlador listar pedidos  ----------*/
    public function listarPedidosControlador($pagina, $registros, $url, $busqueda) {
        $pagina = $this->limpiarCadena($pagina);
        $registros = $this->limpiarCadena($registros);
        $url = APP_URL . $this->limpiarCadena($url) . "/";
        $busqueda = $this->limpiarCadena($busqueda);
        $tabla = "";
    
        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
    
        if ($busqueda != "") {
            $consulta_datos = "SELECT * FROM pedido WHERE nombre_cliente LIKE '%$busqueda%' ORDER BY fecha DESC LIMIT $inicio, $registros";
            $consulta_total = "SELECT COUNT(pedido_id) FROM pedido WHERE nombre_cliente LIKE '%$busqueda%'";
        } else {
            $consulta_datos = "SELECT * FROM pedido ORDER BY fecha DESC LIMIT $inicio, $registros";
            $consulta_total = "SELECT COUNT(pedido_id) FROM pedido";
        }
    
        $datos = $this->ejecutarConsulta($consulta_datos);
        $datos = $datos->fetchAll();
        $total = $this->ejecutarConsulta($consulta_total)->fetchColumn();
        $numeroPaginas = ceil($total / $registros);
    
        $tabla .= '
            <div class="table-container">
            <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                <thead>
                    <tr>
                        <th class="has-text-centered">Pedido ID</th>
                        <th class="has-text-centered">Código Pedido</th>
                        <th class="has-text-centered">Fecha</th>
                        <th class="has-text-centered">Cliente</th>
                        <th class="has-text-centered">Correo</th>
                        <th class="has-text-centered">Celular</th>
                        <th class="has-text-centered">Estado</th>
                        <th class="has-text-centered">Método Pago</th>
                        <th class="has-text-centered">NIT</th>
                        <th class="has-text-centered">Actualizar</th>
                    </tr>
                </thead>
                <tbody>
        ';
    
        if ($total >= 1 && $pagina <= $numeroPaginas) {
            foreach ($datos as $rows) {
                $tabla .= '
                    <tr class="has-text-centered">
                        <td>' . $rows['pedido_id'] . '</td>
                        <td>' . $rows['codigo_pedido'] . '</td>
                        <td>' . $rows['fecha'] . '</td>
                        <td>' . $rows['nombre_cliente'] . '</td>
                        <td>' . $rows['correo_cliente'] . '</td>
                        <td>' . $rows['celular_cliente'] . '</td>
                        <td>
                            <div class="select is-small">
                                <select name="estado_' . $rows['pedido_id'] . '">
                                    <option value="pendiente"' . ($rows['estado'] == 'pendiente' ? ' selected' : '') . '>Pendiente</option>
                                    <option value="comprobado"' . ($rows['estado'] == 'comprobado' ? ' selected' : '') . '>Comprobado</option>
                                    <option value="completado"' . ($rows['estado'] == 'completado' ? ' selected' : '') . '>Completado</option>
                                </select>
                            </div>
                        </td>
                        <td>' . $rows['metodo_pago'] . '</td>
                        <td>' . $rows['nit'] . '</td>
                        <td>
                            <button class="button is-info is-small">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </td>
                    </tr>
                ';
            }
        } else {
            $tabla .= '<tr class="has-text-centered"><td colspan="10">No hay pedidos registrados</td></tr>';
        }
    
        $tabla .= '</tbody></table></div>';
        
        return $tabla;
    }
}
?>
