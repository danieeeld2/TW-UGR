<?php
// Función para, dado un idioma, cargar los mensajes del JSON correspondiente
function cargarMensajes($idioma)
{
    $archivo = "./ej8.json";
    $mensajes = json_decode(file_get_contents($archivo), true);
    return $mensajes[$idioma];
}

// Función para obtener el idioma seleccionado
function obtenerIdioma()
{
    $idiomaPorDefecto = isset($_COOKIE["idioma"]) ? $_COOKIE["idioma"] : "es"; // Si no hay cookie, por defecto español (es
    $idioma = isset($_GET["idioma"]) ? $_GET["idioma"] : $idiomaPorDefecto;
    return $idioma;
}

$idioma = obtenerIdioma();

// Si recibimos un idioma por GET, lo guardamos en una cookie
if (isset($_GET["idioma"])) {
    setcookie("idioma", $idioma, time() + 60 * 60 * 24 * 30); // 30 días
}

$mensajes = cargarMensajes($idioma);

?>

<!DOCTYPE html>
<html lang="<?php echo $idioma; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <p><?php echo $mensajes['Bienvenida']; ?></p>
    <p><?php echo $mensajes['Cambio']; ?></p>

    <form action="" method="GET">
        <fieldset>
            <legend><?php echo $mensajes['ElegirIdioma']; ?></legend>
            <select name="idioma" id="idioma">
                <option value="es" <?php if ($idioma === 'es') echo 'selected'; ?>><?php echo $mensajes['Espanol']; ?></option>
                <option value="en" <?php if ($idioma === 'en') echo 'selected'; ?>><?php echo $mensajes['Ingles']; ?></option>
                <option value="fr" <?php if ($idioma === 'fr') echo 'selected'; ?>><?php echo $mensajes['Frances']; ?></option>
            </select>
            <button type="submit"><?php echo $mensajes['Aplicar']; ?></button>
        </fieldset>
    </form>

    <a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>"><?php echo $mensajes['Enlace']; ?></a>
</body>

</html>