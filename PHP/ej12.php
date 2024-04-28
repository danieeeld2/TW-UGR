<?php
session_start();
if (isset($_POST['borrar'])){
    unset($_SESSION['total']);
    // Para evitar el reenvio del formulario, hacemos que, tras borrar la sesión, se redirija a la misma página con un código de estado 303
    // El cliente recibe la respuesta y realiza una nueva petición GET a la misma URL donde ya no se adjuntan los datos del formulario
    header( "Location: {$_SERVER['SCRIPT_NAME']}", true, 303);
}
if (!isset($_SESSION['total']) or !isset($_SESSION['numero'])) {
    $_SESSION['numero'] = 0;
    $_SESSION['total'] = 0;
}
if (isset($_POST['enviar']) and is_numeric($_POST['donacion'])) {
    $_SESSION['numero']++;
    $_SESSION['total'] += $_POST['donacion'];
    // Para evitar el reenvio del formulario, hacemos que, tras borrar la sesión, se redirija a la misma página con un código de estado 303
    // El cliente recibe la respuesta y realiza una nueva petición GET a la misma URL donde ya no se adjuntan los datos del formulario
    header( "Location: {$_SERVER['SCRIPT_NAME']}", true, 303);
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Ejemplo</title>
</head>

<body>
    <?php
    echo "<p>Hasta ahora hay un total de {$_SESSION['numero']} donaciones.</p>";
    echo "<p>El importe acumulado es de {$_SESSION['total']} euros.</p>";
    if (isset($_POST['donacion']) and is_numeric($_POST['donacion']))
        echo "<p>La última donación fue de {$_POST['donacion']} euros</p>";
    echo form();
    ?>
</body>

</html>
<?php
function form() {
    return <<<HTML
        <form action="{$_SERVER['SCRIPT_NAME']}" method="post">
            <label>Realizar una nueva donación: <input type="text" name="donacion" size="10"></label>
            <p><input type="submit" name="enviar" value="Enviar">
                <input type="submit" name="borrar" value="Borrar sesión"></p>
        </form>\n
    HTML;
}
?>