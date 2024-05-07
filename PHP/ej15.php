<?php 
require_once('funcionesej15.php');
require_once('generarHTMLej15.php');
require_once('funcionesBD.php');
require_once('conexionBD.php');

session_start();

if(isset($_GET['enviar']) && $_SERVER["REQUEST_METHOD"] == "GET") {
    [$_SESSION["errores"], $_SESSION["datos"]] = validarDatos();
} 
if(isset($_GET['confirmar']) && $_SERVER["REQUEST_METHOD"] == "GET") {
    $conexion = conectar_bbdd();
    insertar_usuario($conexion, $_SESSION["datos"]);
    desconectar_bbdd($conexion);
}

generarFORM();


?>


