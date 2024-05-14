<?php 
session_start();

// Inicializamos el tablero si no lo está
if(!isset($_SESSION['tablero'])){
    $_SESSION['tablero'] = array(
        array("bamarillo", "bamarillo", "bamarillo"),
        array("bamarillo", "bamarillo", "bamarillo"),
        array("bamarillo", "bamarillo", "bamarillo")
    );
    $_SESSION['turno'] = "brojo";
}

// Función para posicionar las fichas. Devuelve true si se posiciona correctamente, false en caso contrario
function posicionarFicha($turno, $fila, $columna){
    if($turno == "brojo" && $_SESSION['tablero'][$fila][$columna] == "bamarillo"){
        $_SESSION['tablero'][$fila][$columna] = "brojo";
        $_SESSION['turno'] = "bazul";
    } else if($turno == "bazul" && $_SESSION['tablero'][$fila][$columna] == "bamarillo"){
        $_SESSION['tablero'][$fila][$columna] = "bazul";
        $_SESSION['turno'] = "brojo";
    } 
}

// Procesar la jugada o limpiar el tablero
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['poner00_x'])){
        posicionarFicha($_SESSION['turno'], 0, 0);
    } else if(isset($_POST['poner00_y'])){
        posicionarFicha($_SESSION['turno'], 0, 0);
    } else if(isset($_POST['poner01_x'])){
        posicionarFicha($_SESSION['turno'], 0, 1);
    } else if(isset($_POST['poner01_y'])){
        posicionarFicha($_SESSION['turno'], 0, 1);
    } else if(isset($_POST['poner02_x'])){
        posicionarFicha($_SESSION['turno'], 0, 2);
    } else if(isset($_POST['poner02_y'])){
        posicionarFicha($_SESSION['turno'], 0, 2);
    } else if(isset($_POST['poner10_x'])){
        posicionarFicha($_SESSION['turno'], 1, 0);
    } else if(isset($_POST['poner10_y'])){
        posicionarFicha($_SESSION['turno'], 1, 0);
    } else if(isset($_POST['poner11_x'])){
        posicionarFicha($_SESSION['turno'], 1, 1);
    } else if(isset($_POST['poner11_y'])){
        posicionarFicha($_SESSION['turno'], 1, 1);
    } else if(isset($_POST['poner12_x'])){
        posicionarFicha($_SESSION['turno'], 1, 2);
    } else if(isset($_POST['poner12_y'])){
        posicionarFicha($_SESSION['turno'], 1, 2);
    } else if(isset($_POST['poner20_x'])){
        posicionarFicha($_SESSION['turno'], 2, 0);
    } else if(isset($_POST['poner20_y'])){
        posicionarFicha($_SESSION['turno'], 2, 0);
    } else if(isset($_POST['poner21_x'])){
        posicionarFicha($_SESSION['turno'], 2, 1);
    } else if(isset($_POST['poner21_y'])){
        posicionarFicha($_SESSION['turno'], 2, 1);
    } else if(isset($_POST['poner22_x'])){
        posicionarFicha($_SESSION['turno'], 2, 2);
    } else if(isset($_POST['poner22_y'])){
        posicionarFicha($_SESSION['turno'], 2, 2);
    } else if(isset($_POST['limpiar'])){
        $_SESSION['tablero'] = array(
            array("bamarillo", "bamarillo", "bamarillo"),
            array("bamarillo", "bamarillo", "bamarillo"),
            array("bamarillo", "bamarillo", "bamarillo")
        );
        $_SESSION['turno'] = "brojo";
    }
    // Redirigir para evitar reenvío del formulario
    header( "Location: {$_SERVER['SCRIPT_NAME']}", true, 303);
}

// Funcion para comprobar si hay ganador y donde se encuentra el ganador
function comprobarGanador($fila, $columna) {
    $color = $_SESSION['tablero'][$fila][$columna];
    if($color == "bamarillo") {
        return false;
    } elseif($_SESSION['tablero'][$fila][($columna+1)%3] == $color && $_SESSION['tablero'][$fila][($columna+2)%3] == $color){
        return true;
    }
    elseif($_SESSION['tablero'][($fila+1)%3][$columna] == $color && $_SESSION['tablero'][($fila+2)%3][$columna] == $color){
        return true;
    }
    else if($fila == $columna && $_SESSION['tablero'][($fila+1)%3][($columna+1)%3] == $color && $_SESSION['tablero'][($fila+2)%3][($columna+2)%3] == $color){
        return true;
    }
    else if(($fila == 1 && $columna == 1) || ($fila - $columna == 2) || ($columna - $fila == 2)){
        if($_SESSION['tablero'][($fila+1)%3][($columna-1)%3] == $color && $_SESSION['tablero'][($fila-1)%3][($columna+1)%3] == $color){
            return true;
        }
    }
    else {
        return false;
    }
}

// Funcion para procesar la clase
function procesarClase($fila, $columna) {
    if($_SESSION['tablero'][$fila][$columna] == "bamarillo") {
        return "libre";
    } else if(comprobarGanador($fila, $columna)) {
        return "ganador";
    } else {
        return "";
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>3 en raya</title>
    <style>
        body {
            font-family: helvetica;
        }

        .juego {
            width: 200px;
            margin: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .juego>h1 {
            width: 100%;
            background-color: lightgreen;
            text-align: center;
        }

        .juego>.informacion {
            width: 100%;
            background-color: lightgreen;
        }

        .informacion {
            margin: 5px 0;
            padding: 5px;
        }

        .informacion img {
            vertical-align: middle;
        }

        .informacion p {
            text-align: center;
            margin: auto;
        }

        .libre {
            transition: transform .5s ease-in-out;
        }

        .libre:hover {
            transform: scale(1.5);
            cursor: pointer;
        }

        .ganador {
            animation: anim 0.5s infinite linear alternate;
        }

        @keyframes anim {
            from {
                transform: scale(1);
            }

            to {
                transform: scale(1.5);
            }
        }
    </style>
</head>

<body>
    <section class="juego">
        <h1>3 en raya</h1>
        <section class="tablero">
            <form method="post" action="">
                <table>
                    <tr>
                        <td><input type="image" class="<?php echo procesarClase(0,0); ?>" src="<?php echo $_SESSION['tablero'][0][0] ?>.png" width="50px" formmethod="post" name="poner00" /></td>
                        <td><input type="image" class="<?php echo procesarClase(0,1); ?>" src="<?php echo $_SESSION['tablero'][0][1] ?>.png" width="50px" formmethod="post" name="poner01" /></td>
                        <td><input type="image" class="<?php echo procesarClase(0,2); ?>" src="<?php echo $_SESSION['tablero'][0][2] ?>.png" width="50px" formmethod="post" name="poner02" /></td>
                    </tr>
                    <tr>
                        <td><input type="image" class="<?php echo procesarClase(1,0); ?>" src="<?php echo $_SESSION['tablero'][1][0] ?>.png" width="50px" formmethod="post" name="poner10" /></td>
                        <td><input type="image" class="<?php echo procesarClase(1,1); ?>" src="<?php echo $_SESSION['tablero'][1][1] ?>.png" width="50px" formmethod="post" name="poner11" /></td>
                        <td><input type="image" class="<?php echo procesarClase(1,2); ?>" src="<?php echo $_SESSION['tablero'][1][2] ?>.png" width="50px" formmethod="post" name="poner12" /></td>
                    </tr>
                    <tr>
                        <td><input type="image" class="<?php echo procesarClase(2,0); ?>" src="<?php echo $_SESSION['tablero'][2][0] ?>.png" width="50px" formmethod="post" name="poner20" /></td>
                        <td><input type="image" class="<?php echo procesarClase(2,1); ?>" src="<?php echo $_SESSION['tablero'][2][1] ?>.png" width="50px" formmethod="post" name="poner21" /></td>
                        <td><input type="image" class="<?php echo procesarClase(2,2); ?>" src="<?php echo $_SESSION['tablero'][2][2] ?>.png" width="50px" formmethod="post" name="poner22" /></td>
                    </tr>
                </table>
            </form>
        </section>
        <section class="informacion">
            <p>Turno: <?php echo '<img src="' . $_SESSION['turno'] . '.png" width="25px"/>'; ?></p>
        </section>
        <section class="botones">
            <form method="post" action="">
                <input type="submit" name="limpiar" value="Limpiar" />
            </form>
        </section>
    </section>
</body>

</html>