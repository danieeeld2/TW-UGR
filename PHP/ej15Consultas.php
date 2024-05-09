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

// Definir número de tuplas por página
$_SESSION['tuplas'] = isset($_GET['N-Tuplas']) ? $_GET['N-Tuplas'] : 10;
$_SESSION['pagina'] = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$_SESSION['offset'] = ($_SESSION['pagina'] - 1) * $_SESSION['tuplas'];

// Obtener el total de tuplas
$_SESSION['total-tuplas'] = obtener_total_tuplas($conexion);
$_SESSION['total-paginas'] = ceil($_SESSION['total-tuplas'] / $_SESSION['tuplas']);

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


$_SESSION["usuarios"] = obtener_usuarios_paginados($conexion, $_SESSION['offset'], $_SESSION['tuplas']);
desconectar_bbdd($conexion);

generarTabla();

?>