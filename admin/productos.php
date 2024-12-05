<?php
// Incluimos las clases necesarias
include __DIR__ . '/productos.class.php';
include __DIR__ . '/marca.class.php';
include __DIR__ . '/categoria.class.php'; // Asegúrate de incluir la clase Categoria si la usas
include __DIR__ . '/views/header.php';

// Instanciamos las clases
$app = new Productos();
$appMarcas = new Marca();
$appCategorias = new Categoria(); // Si también usas categorias

// Comprobamos el rol del usuario
//$app->checkRol('Administrador', true);

// Obtenemos las marcas y categorias
$marcas = $appMarcas->getAll();
$categorias = $appCategorias->getAll(); // Si usas categorias

// Obtenemos los datos de la acción
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
$id_producto = (isset($_GET['id_producto'])) ? $_GET['id_producto'] : null;
$datos = array();
$alert = array();

// Lógica para cada acción
switch ($action) {
    case "DELETE":
        if ($id_producto && $app->delete($id_producto)) {
            $alert['type'] = 'success';
            $alert['message'] = '<i class="fa-solid fa-circle-check"></i> Producto eliminado correctamente';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se pudo eliminar el producto o el producto no existe';
        }
        $datos = $app->getAll();
        include __DIR__ . '/views/alert.php';
        include __DIR__ . '/views/productos/index.php';
        break;
    case "UPDATE":
        $datos = $app->getOne($id_producto);
        if (isset($datos['id_producto'])) {
            include __DIR__ . '/views/productos/form.php';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se ha encontrado el producto especificado';
            $datos = $app->getAll();
            include __DIR__ . '/views/alert.php';
            include __DIR__ . '/views/productos/index.php';
        }
        break;
    case "CREATE":
        include __DIR__ . '/views/productos/form.php';
        break;
    case "SAVE":
        $datos = $_POST;
        if ($app->insert($datos) && isset($datos['id_marca'])) {
            $alert['type'] = 'success';
            $alert['message'] = '<i class="fa-solid fa-circle-check"></i> Producto registrado correctamente';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se pudo registrar el producto';
        }
        $datos = $app->getAll();
        include __DIR__ . '/views/alert.php';
        include __DIR__ . '/views/productos/index.php';
        break;
    case "EDIT":
        $datos = $_POST;
        if ($app->update($id_producto, $datos)) {
            $alert['type'] = 'success';
            $alert['message'] = '<i class="fa-solid fa-circle-check"></i> Producto actualizado correctamente';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se pudo actualizar el producto';
        }
        $datos = $app->getAll();
        include __DIR__ . '/views/alert.php';
        include __DIR__ . '/views/productos/index.php';
        break;
    default:
        $datos = $app->getAll();
        include __DIR__ . '/views/productos/index.php';
        break;
}

include __DIR__ . '/views/footer.php';
