<?php
include __DIR__ . '/categoria.class.php';
$app = new Categoria();
include __DIR__ . '/views/header.php';
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
$id_categoria = (isset($_GET['id_categoria'])) ? $_GET['id_categoria'] : null;
$datos = array();
$alert = array();

switch ($action) {
    case "DELETE":
        if ($app->delete($id_categoria)) {
            $alert['type'] = 'success';
            $alert['message'] = '<i class="fa-solid fa-circle-check"></i> Categoría eliminada correctamente';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se pudo eliminar la categoría';
        }
        $datos = $app->getAll();
        include __DIR__ . '/views/alert.php';
        include __DIR__ . '/views/categoria/index.php';
        break;

    case "UPDATE":
        $datos = $app->getOne($id_categoria);
        if (isset($datos['id_categoria'])) {
            include __DIR__ . '/views/categoria/form.php';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se ha encontrado la categoría especificada';
            $datos = $app->getAll();
            include __DIR__ . '/views/alert.php';
            include __DIR__ . '/views/categoria/index.php';
        }
        break;

    case "CREATE":
        include __DIR__ . '/views/categoria/form.php';
        break;

    case "SAVE":
        $datos = $_POST;
        if ($app->insert($datos)) {
            $alert['type'] = 'success';
            $alert['message'] = '<i class="fa-solid fa-circle-check"></i> Categoría registrada correctamente';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se pudo registrar la categoría';
        }
        $datos = $app->getAll();
        include __DIR__ . '/views/alert.php';
        include __DIR__ . '/views/categoria/index.php';
        break;

    case "EDIT":
        $datos = $_POST;
        if ($app->update($id_categoria, $datos)) {
            $alert['type'] = 'success';
            $alert['message'] = '<i class="fa-solid fa-circle-check"></i> Categoría actualizada correctamente';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se pudo actualizar la categoría';
        }
        $datos = $app->getAll();
        include __DIR__ . '/views/alert.php';
        include __DIR__ . '/views/categoria/index.php';
        break;

    default:
        $datos = $app->getAll();
        include __DIR__ . '/views/categoria/index.php';
        break;
}

include __DIR__ . '/views/footer.php';
?>
