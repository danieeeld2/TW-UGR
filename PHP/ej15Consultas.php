<?php 
require_once('funcionesBD.php');
require_once('conexionBD.php');
require_once('ej15HTMLConsultas.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$conexion = conectar_bbdd();

// Vaciamos los errores y los datos de la sesión si existen, para resetear el formulario cuando volvamos
if(isset($_SESSION['errores'])) {
    unset($_SESSION['errores']);
}
if(isset($_SESSION['datos'])) {
    unset($_SESSION['datos']);
}

if(isset($_POST['borrar']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    borrar_usuario($conexion, $_POST['id']);
    // Redireccionamos a la misma página pero con GET para evitar que se vuelva a enviar el formulario
    header( "Location: {$_SERVER['SCRIPT_NAME']}", true, 303);
}

if(isset($_POST['modificar']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $resultado = obtener_usuario($conexion, $_POST['id']);
    $_SESSION['datos']["nombre"] = $resultado["Nombre"];
    $_SESSION['datos']["apellidos"] = $resultado["Apellidos"];
    $_SESSION['datos']["dni"] = $resultado["DNI"];
    $_SESSION['datos']["fecha-nacimiento"] = $resultado["FechaNacimiento"];
    $_SESSION['datos']["nacionalidad"] = $resultado["Nacionalidad"];
    $_SESSION['datos']["sexo"] = $resultado["Sexo"];
    $_SESSION['datos']["email"] = $resultado["Email"];
    $_SESSION['datos']["clave"] = $resultado["Clave"];
    $_SESSION['datos']["idioma-comunicacion"] = $resultado["Idioma"];
    $_SESSION['datos']["preferencia"] = $resultado["Preferencia"];
    $_SESSION['datos']["tratamiento"] = $resultado["TratamientoDatos"];
    $_SESSION["id"] = $resultado["id"];
    $_SESSION['modificar'] = true;
    header( "Location: ej15.php", true, 303);
}


$_SESSION["usuarios"] = obtener_usuarios($conexion);
desconectar_bbdd($conexion);

generarTabla();

?>