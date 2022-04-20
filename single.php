<?php
require 'admin/config.php';
require 'funcion.php';

$conexion = conexion($bd_config);
$idArticulos = idArticulos($_GET['id']);

if (!$conexion) {
    header('location: error.php');
} 

if (empty($idArticulos)) {
    header('location: index.php');
}

$post = obtenerPostPorId($conexion, $idArticulos);

if (!$post) {
    header('location: index.php');
}

$post = $post[0];

require 'views/single-view.php';
?>