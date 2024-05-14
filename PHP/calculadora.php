<?php

// Comprobaciones dato numero 1
$error1 = false;
if(isset($_GET['numero1'])){
    if(is_numeric($_GET['numero1'])){
        $numero1 = $_GET['numero1'];
    } else {
        $numero1 = 'ERROR: El primer dato no es válido. No es un número';
        $error1 = true;
    }
} else {
    $numero1 = '';
}

// Comprobaciones dato numero 2
$error2 = false;
if(isset($_GET['numero2'])){
    if(is_numeric($_GET['numero2'])){
        $numero2 = $_GET['numero2'];
    } else {
        $numero2 = 'ERROR: El segundo dato no es válido. No es un número';
        $error2 = true;
    }
} else {
    $numero2 = '';
}

// Procesar errores
$text1 = "";
if($error1){
    $text1 = "<p class='error'>$numero1</p>";
}
$text2 = "";
if($error2){
    $text2 = "<p class='error'>$numero2</p>";
}

// Operaciones
if(!$error1 && !$error2){
    if(array_key_exists("suma", $_GET)){
        $text1 = "<p>Operación: <span>Suma</span></p>";
        $resultado = $numero1 + $numero2;
        $text2 = "<p>Resultado: <span>$resultado</span></p>";
    } else if(array_key_exists("resta", $_GET)){
        $text1 = "<p>Operación: <span>Resta</span></p>";
        $resultado = $numero1 - $numero2;
        $text2 = "<p>Resultado: <span>$resultado</span></p>";
    } else if(array_key_exists("producto", $_GET)){
        $text1 = "<p>Operación: <span>Producto</span></p>";
        $resultado = $numero1 * $numero2;
        $text2 = "<p>Resultado: <span>$resultado</span></p>";
    } else if(array_key_exists("division", $_GET)){
        $text1 = "<p>Operación: <span>División</span></p>";
        if($numero2 == 0){
            $text2 = "<p class='error'>ERROR: No se puede dividir por 0</p>";
        } else {
            $resultado = $numero1 / $numero2;
            $text2 = "<p>Resultado: <span>$resultado</span></p>";
        }
    }
}

// No eliminar los datos correctos
$value1 = !$error1 ? $numero1 : "";
$value2 = !$error2 ? $numero2 : "";

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Calculadora</title>
    <style>
        main {
            font-family: Arial;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        form {
            border: 2px solid lightgray;
            padding: 5px;
            display: inline-flex;
            align-items: center;
            background-color: lightblue;
        }

        fieldset {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 10px;
            display: flex;
            flex-direction: column;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <main>
        <h1>Calculadora</h1>
        <form action="" method="GET">
            <label><span>Dato 1</span><input type="text" name="numero1" placeholder="Introduce un número" value="<?php echo $value1; ?>" /></label>
            <fieldset>
                <legend>Operación</legend>
                <input type="submit" name="suma" value="+">
                <input type="submit" name="resta" value="-">
                <input type="submit" name="producto" value="*">
                <input type="submit" name="division" value="/">
            </fieldset>
            <label><span>Dato 2</span><input type="text" name="numero2" placeholder="Introduce un número" value="<?php echo $value2; ?>" /></label>
        </form>
        <section>
            <?php echo $text1; ?>
            <?php echo $text2; ?>
        </section>
    </main>
</body>

</html>