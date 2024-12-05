<?php
require_once('rol.class.php');
$app = new Rol();
$app->checkRol('Administrador');

$accion = (isset($_GET['accion'])) ? $_GET['accion'] : NULL;
$id = (isset($_GET['id'])) ? $_GET['id'] : null;

switch ($accion) {
    case 'crear':
        include 'views/rol/crear.php';
        break;
    case 'nuevo':
        $data = $_POST['data'];
        $resultado = $app->create($data);
        if ($resultado) {
            $mensaje = "El rol se agregó correctamente :)";
            $tipo = "success";
        } else {
            $mensaje = "ERROR! :(";
            $tipo = "danger";
        }
        $roles = $app->readAll();
        include('views/rol/index.php');
        break;
    case 'actualizar':
        $rol = $app->readOne($id);
        include('views/rol/crear.php');
        break;
    case 'modificar':
        $data = $_POST['data'];
        $resultado = $app->update($id, $data);
        if ($resultado) {
            $mensaje = "El rol se actualizó correctamente! :)";
            $tipo = "success";
        } else {
            $mensaje = "ERROR!, el rol no fue actualizado :(";
            $tipo = "danger";
        }
        $roles = $app->readAll();
        include('views/rol/index.php');
        break;
    case 'eliminar':
        if (!is_null($id)) {
            if (is_numeric($id)) {
                $resultado = $app->delete($id);
                if ($resultado) {
                    $mensaje = "El rol se ha eliminado correctamente :)";
                    $tipo = "success";
                } else {
                    $mensaje = "ERROR! :(";
                    $tipo = "danger";
                }
            }
        }
        $roles = $app->readAll();
        include("views/rol/index.php");
        break;
    default:
        $roles = $app->readAll();
        include 'views/rol/index.php';
}

require_once('views/footer.php');