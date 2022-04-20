<?php session_start();

require 'admin/config.php';
require 'funcion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = limpiarDatos($_POST['usuario']);
    $password = limpiarDatos($_POST['password']);

    if($usuario == $blog_admin['usuario'] && $password == $blog_admin['password']){
        $_SESSION['admin'] = $blog_admin['usuario'];
        header('location:' . RUTA . '/admin');
    }
}
require 'views/login-view.php';
?>