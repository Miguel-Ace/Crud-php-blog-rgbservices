<?php
function conexion ($bd_config){
    try {
        $conexion = new PDO('mysql:host=localhost;dbname='.$bd_config['basedatos'], $bd_config['usuario'], $bd_config['pass']);
        return $conexion;
    } catch (PDOException $e) {
        return false;
    }
}

function limpiarDatos($datos){
    $datos = trim($datos);
    $datos = stripcslashes($datos);
    $datos = htmlspecialchars($datos);
    return $datos;
}

function paginaActual(){
    return isset($_GET['p']) ? (int)$_GET['p'] : 1 ;
}

function obtenerPost($postPorPagina, $conexion){
    $inicio = (paginaActual() > 1) ? paginaActual() * $postPorPagina - $postPorPagina : 0 ;
    $sentencia = $conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM articulos LIMIT $inicio, $postPorPagina");
    $sentencia->execute();
    return $sentencia->fetchAll();
}

function numeroPaginas($conexion, $postPorPagina){
    $totalPost = $conexion->prepare('SELECT FOUND_ROWS() as total');
    $totalPost->execute();
    $totalPost = $totalPost->fetch()['total'];

    $numeroPaginas = ceil($totalPost / $postPorPagina);
    return $numeroPaginas;
}

function idArticulos($id){
    return (int)limpiarDatos($id);
}

function obtenerPostPorId($conexion , $id){
    $resultado = $conexion->query("SELECT * FROM articulos WHERE id = $id LIMIT 1");
    $resultado = $resultado->fetchAll();
    return ($resultado) ? $resultado : false ;
}

function fecha($fecha){
    $time = strtotime($fecha);
    $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Jilio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

    $dia = date('d', $time);
    $mes = date('m', $time) - 1;
    $year = date('y', $time);

    $fecha = "$dia de " . $meses[$mes] . " del $year";
    return $fecha;
}

function comprobarSession(){
	if (!isset($_SESSION['admin'])) {
		header('Location: ' . RUTA);
	}
}
?>