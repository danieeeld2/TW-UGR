<?php
// Obtener el tralling path de la URL
preg_match('#([^/]*php)/(.*)$#', $_SERVER['PHP_SELF'], $matches);
$chunks = (count($matches) > 0) ? explode('/', $matches[2]) : [];

// Verificar si hay suficientes fragmentos para determinar la operación
if (count($chunks) > 0) {
    $operation = $chunks[0];

    if(isset($_GET['a']) && isset($_GET['b']) && is_numeric($_GET['a']) && is_numeric($_GET['b'])) {
        $a = $_GET['a'];
        $b = $_GET['b'];

        switch ($operation) {
            case 'suma':
                $result = $a + $b;
                break;
            case 'resta':
                $result = $a - $b;
                break;
            case 'multiplica':
                $result = $a * $b;
                break;
            case 'divide':
                if($b != 0) {
                    $result = $a / $b;
                } else {
                    $result = 'No se puede dividir por cero';
                }
                break;
            default:
                $result = 'Operación no válida';
                break;
        }
    } else {
        $result = 'No se han proporcionado los operandos de forma correcta';
        if(isset($_GET['a']) && is_numeric($_GET['a'])) {
            $a = $_GET['a'];
        } else {
            if(isset($_GET['a'])) {
                $a = 'Inváido';
            } else {
                $a = 'No proporcionado';
            }
        }
        if(isset($_GET['b']) && is_numeric($_GET['b'])) {
            $b = $_GET['b'];
        } else {
            if(isset($_GET['b'])) {
                $b = 'Inváido';
            } else {
                $b = 'No proporcionado';
            }
        }
    }
} else {
    $operation = 'No disponible';
    $a = 'No disponible';
    $b = 'No disponible';
    $result = 'No hay trailing path';
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
    <h2>Operar</h2>
    <ul>
        <li>Operación: <?php echo $operation; ?></li>
        <li>Operando A: <?php echo $a; ?></li>
        <li>Operando B: <?php echo $b; ?></li>
        <li>Resultado: <?php echo $result; ?></li>
    </ul>
</body>
</html>