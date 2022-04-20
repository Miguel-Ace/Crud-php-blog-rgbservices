<?php session_start();

require 'config.php';
require '../funcion.php';

comprobarSession();

$conexion = conexion($bd_config);
if (!$conexion) {
    header('location: ../error.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = limpiarDatos($_POST['titulo']);
    $extracto = limpiarDatos($_POST['extracto']);
    $texto = $_POST['texto'];
    $id = limpiarDatos($_POST['id']);
    $thumb_guardada = $_POST['thumb-guardada'];
    $thumb = $_FILES['thumb'];

    if (!empty($thumb['name'])) {
        $thumb = $thumb_guardada;
    }else{
        $archibo_subido = '../' . $blog_config['carpeta_imagenes'] . $_FILES['thumb']['name'];
        move_uploaded_file($_FILES['thumb']['tmp_name'], $archibo_subido);
        $thumb = $_FILES['thumb']['name'];
    }

    $statement = $conexion->prepare('UPDATE articulos SET titulo = :titulo, extracto = :extracto, texto = :texto, thumb = :thumb WHERE id = :id');
    $statement->execute([':titulo' => $titulo, ':extracto' => $extracto, ':texto' => $texto, ':thumb' => $thumb, ':id' => $id]);
    
    header('location: ' . RUTA .  '/admin');
}else{
    $id_articulo = idArticulos($_GET['id']);

    if (empty($id_articulo)) {
        header('location:' . RUTA . '/admin');
    }

    $post = obtenerPostPorId($conexion , $id_articulo);

    if (empty($post)) {
        header('location:' . RUTA . '/admin');
    }

    $post = $post[0];
}

require '../views/editar-view.php';
?>