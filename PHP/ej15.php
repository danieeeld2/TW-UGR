<?php 
require_once('funcionesej15.php');
require_once('generarHTMLej15.php');
require_once('funcionesBD.php');
require_once('conexionBD.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_GET['enviar']) && $_SERVER["REQUEST_METHOD"] == "GET") {
    [$_SESSION["errores"], $_SESSION["datos"]] = validarDatos();
} 
if(isset($_GET['confirmar']) && $_SERVER["REQUEST_METHOD"] == "GET") {
    $conexion = conectar_bbdd();
    if(isset($_SESSION['modificar'])) {
        modificar_usuario($conexion, $_SESSION['datos'], $_SESSION["id"]);
        unset($_SESSION['modificar']);
    } else {
        insertar_usuario($conexion, $_SESSION["datos"]);
    }

    desconectar_bbdd($conexion);
    unset($_SESSION["datos"]);
    unset($_SESSION["errores"]);
    unset($_SESSION["id"]);
}

generarFORM();


?>


