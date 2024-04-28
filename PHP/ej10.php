<?php 
session_start();

// Verificamos si se solicita borrar la sesión
if(isset($_POST['borrar_sesion'])){
    session_unset(); // Elimina todas las variables de sesión
    session_destroy(); // Destruye la sesión
    header("Location: ".$_SERVER['SCRIPT_NAME']); // Redirecciona para volver a cargar la página
    exit;
}

// Verificamos si el usuario proporcionó un nombre
if(isset($_POST['nombre'])){
    // Si previamente había especificado un nombre, reiniciamos la lista de números aleatorios (si el nombre es distinto al anterior)
    if(isset($_SESSION['nombre']) && $_POST['nombre'] != $_SESSION['nombre']){
        $_SESSION['numeros'] = array();
    } else if (!isset($_SESSION['nombre'])){ // Si no había especificado un nombre, reiniciamos la lista de números aleatorios
        $_SESSION['numeros'] = array();
    }
    // Guardamos el nombre en la sesión
    $_SESSION['nombre'] = $_POST['nombre'];
}

// Generamos un número aleatorio
$numero = rand(1, PHP_INT_MAX);

// Inicializamos la lista de números aleatorios si no existe
if(!isset($_SESSION['numeros'])){
    $_SESSION['numeros'] = array();
}

// Añadimos el número a la lista
array_push($_SESSION['numeros'], $numero);

// Funcion para mostrar la lista de números aleatorios
function mostrarLista(){
    $lista = "<ol>";
    foreach($_SESSION['numeros'] as $numero){
        $lista .= "<li>$numero</li>";
    }
    $lista .= "</ol>";
    return $lista;
}

// Texto a mostrar en caso de que el usuario haya proporcionado un nombre o no
if(isset($_SESSION['nombre'])){
    $nombre = $_SESSION['nombre'];
    $texto = "<p>Bienvenido $nombre</p>" . "\n" . mostrarLista() . "\n" . "<p>El nuevo número es: $numero</p>";
} else {
    $texto = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php echo $texto; ?>
    <form action =""  method="post">
        <label for="nombre">Diganos su nombre para comenzar:</label>
        <input type="text" name="nombre" id="nombre">
        <input type="submit" value="Enviar">
        <input type="submit" name="borrar_sesion" value="Borrar sesión">
    </form>
    <a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>">Cargar de nuevo</a>
</body>
</html>