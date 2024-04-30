<?php 

// Si se ha enviado el formulario, comprobamos los datos
if(isset($_GET['submit']) && $_SERVER["REQUEST_METHOD"] == "GET"){
    // Inicializamos el array de errores
    $errores = array();
    // Comprobar que el nombre no es vacío 
    if(empty($_GET["nombre"])){
        $errores["nombre"] = "<p class='error'>El nombre es obligatorio</p>";
        $nombre = "";
    } else {
        // Comprobar que el nombre epieza por mayúsculas
        if(!preg_match("/^[A-Z][a-zA-Z]*$/", $_GET["nombre"])){
            $errores["nombre"] = "<p class='error'>El nombre debe empezar por mayúsculas</p>";
            $nombre = "";
        } else {
            $nombre = $_GET["nombre"];
        }
    }

    // El apellido no es obligatorio, pero si se introduce, debe empezar por mayúsculas
    if(!empty($_GET["apellidos"])){
        if(!preg_match("/^[A-Z][a-zA-Z]*$/", $_GET["apellidos"])){
            $errores["apellidos"] = "<p class='error'>El apellido debe empezar por mayúsculas</p>";
            $apellidos = "";
        } else {
            $apellidos = $_GET["apellidos"];
        }
    } else {
        $apellidos = "";
    }

    // El DNI es obligatorio y debe tener 8 dígitos y una letra mayúscula
    if(empty($_GET["dni"])){
        $errores["dni"] = "<p class='error'>El DNI es obligatorio</p>";
        $dni = "";
    } else {
        if(!preg_match("/^[0-9]{8}[A-Z]$/", $_GET["dni"])){
            $errores["dni"] = "<p class='error'>El DNI debe tener 8 dígitos y una letra mayúscula</p>";
            $dni = "";
        } else {
            $dni = $_GET["dni"];
        }
    }

    // La fecha de nacimiento es obligatoria
    if(empty($_GET["fecha-nacimiento"])){
        $errores["fecha-nacimiento"] = "<p class='error'>La fecha de nacimiento es obligatoria</p>";
        $fechaNacimiento = "";
    } else {
        // La persona debe ser mayor de edad
        $fechaActual = new DateTime();
        $fechaNacimiento = new DateTime($_GET["fecha-nacimiento"]);
        $edad = $fechaActual->diff($fechaNacimiento);
        if($edad->y < 18){
            $errores["fecha-nacimiento"] = "<p class='error'>Debes ser mayor de edad para registrarte</p>";
            $fechaNacimiento = "";
        } else {
            $fechaNacimiento = $_GET["fecha-nacimiento"];
        }
    }

    // No es obligatorio indicar la nacionalidad
    if(!empty($_GET["nacionalidad"])){
        $nacionalidad = $_GET["nacionalidad"];
    } else {
        $nacionalidad = "";
    }

    // El sexo es obligatorio y debe ser uno de los 3 valores permitidos
    if(empty($_GET["sexo"])){
        $errores["sexo"] = "<p class='error'>El sexo es obligatorio</p>";
        $sexo = "No deseo responder";
    } else {
        if($_GET["sexo"] != "Masculino" && $_GET["sexo"] != "Femenino" && $_GET["sexo"] != "No deseo responder"){
            $errores["sexo"] = "<p class='error'>El sexo debe ser Masculino, Femenino o No deseo responder</p>";
            $sexo = "No deseo responder";
        } else {
            $sexo = $_GET["sexo"];
        }
    }

    // El email es obligatorio y debe tener un formato válido
    if(empty($_GET["email"])){
        $errores["email"] = "<p class='error'>El email es obligatorio</p>";
        $email = "";
    } else {
        if(!filter_var($_GET["email"], FILTER_VALIDATE_EMAIL)){
            $errores["email"] = "<p class='error'>El email no tiene un formato válido</p>";
            $email = "";
        } else {
            $email = $_GET["email"];
        }
    }

    // La clave es obligatoria y ha de coincidir con la clave repetida
    if(empty($_GET["clave"])){
        $errores["clave"] = "<p class='error'>La clave es obligatoria</p>";
        $clave = "";
        $claveRepetida = "";
    } else {
        $clave = $_GET["clave"];
        if(empty($_GET["clave-repetida"])){
            $errores["clave-repetida"] = "<p class='error'>Debe repetir la clave</p>";
            $claveRepetida = "";
        } else {
            $claveRepetida = $_GET["clave-repetida"];
            if($clave != $claveRepetida){
                $errores["clave-repetida"] = "<p class='error'>Las claves no coinciden</p>";
                $claveRepetida = "";
            }
        }
    }

    // El idioma de comunicación es obligatorio y debe ser uno de los 3 valores permitidos
    if(empty($_GET["idioma-comunicacion"])){
        $errores["idioma-comunicacion"] = "<p class='error'>El idioma de comunicación es obligatorio</p>";
        $idiomaComunicacion = "español";
    } else {
        if($_GET["idioma-comunicacion"] != "español" && $_GET["idioma-comunicacion"] != "ingles" && $_GET["idioma-comunicacion"] != "frances"){
            $errores["idioma-comunicacion"] = "<p class='error'>El idioma de comunicación debe ser español, inglés o francés</p>";
            $idiomaComunicacion = "español";
        } else {
            $idiomaComunicacion = $_GET["idioma-comunicacion"];
        }
    }

    // La preferencia de habitación no es obligatoria, pero si se indica, debe ser uno de los 4 valores permitidos
    if(!empty($_GET["preferencia"])){
        $preferencias = array();
        foreach ($_GET["preferencia"] as $valor){
            if(in_array($valor, array("fumadores", "mascotas", "vistas", "moqueta"))){
                $preferencias[] = $valor;
            }
        }
        $preferencia = !empty($preferencias) ? implode(',', $preferencias) : '';
        if(empty($preferencia)){
            $errores["preferencia"] = "<p class='error'>Las preferencias de habitación no son válidas</p>";
        }
    } else {
        $preferencia = "";
        $preferencias = array();
    }

    // El tratamiento de datos es obligatorio y debe ser uno de los 3 valores permitidos
    if(empty($_GET["tratamiento"])){
        $errores["tratamiento"] = "<p class='error'>El tratamiento de datos es obligatorio</p>";
        $tratamiento = "TOTAL";
    } else {
        if($_GET["tratamiento"] != "TOTAL" && $_GET["tratamiento"] != "PARCIAL" && $_GET["tratamiento"] != "NINGUNO"){
            $errores["tratamiento"] = "<p class='error'>El tratamiento de datos debe ser TOTAL, PARCIAL o NINGUNO</p>";
            $tratamiento = "TOTAL";
        } else {
            $tratamiento = $_GET["tratamiento"];
        }
    }

    // Si no hay errores, mostramos los datos y el mensaje de confirmación
    if(empty($errores)){
        $texto_recibido = "<h2 class='datos-recibidos'>Los datos se han recibido correctamente</h2>";
        $submit = "Confirmar datos";
        $disable = "disabled";
    } else {
        $texto_recibido = "";
        $submit = "Enviar datos";
        $disable = "";
    }
} else {
    // Si no se ha enviado el formulario, inicializamos las variables
    $nombre = "";
    $apellidos = "";
    $fotografia = "";
    $dni = "";
    $fechaNacimiento = "";
    $nacionalidad = "";
    $sexo = "No deseo responder";
    $email = "";
    $clave = "";
    $claveRepetida = "";
    $idiomaComunicacion = "español";
    $preferencia = "";
    $tratamiento = "TOTAL";
    $submit =  "Enviar datos";
    $texto_recibido = "";
    $disable = ""; 
    $preferencias = array();
}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="ej14.css">
</head>
<body>
    <header>
        <div class="logo">
            <div class="logo-image">
                <img src="img/logo-hotel.png" alt="Logo del hotel">
            </div>
            <h1>Hotel Alhambra</h1>
        </div>
        <aside class="contact-info">
            <img src="img/contacto.png" alt="Datos de Contacto">
        </aside>
    </header>
    <nav>
        <ul>
            <li><a href="ej14-inicio.html">Inicio</a></li>
            <li><a href="ej14-habitaciones.html">Habitaciones</a></li>
            <li><a href="ej14-servicios.html">Servicios</a></li>
            <li><a href="ej14-reservas.html">Reservas</a></li>
            <li><a href="ej14-datos.html">Datos</a></li>
        </ul>
        <ul class="sesion-pantalla-reducida">
            <li><a href="">LogIn</a></li>
        </ul>
    </nav>

    <!-- No coloco las imágenes y los enlaces de interés en main, porque este tag está reservado
    para la información que está directamente relacionado con el tema de la página, que, en este caso,
    sería presentar el hotel -->

    <div class="container">
        <div class="main">
            <main>
                <section class="registro-usuarios">
                    <?php echo $texto_recibido ?>
                    <h2>Registro de Usuarios</h2>
                    <form action="" method="get" novalidate>
                        <fieldset class="datos-personales">
                            <legend>Datos personales</legend>
                            <p>
                                <label for="idnombre">Nombre:</label>
                                <input type="text" id="idnombre" name="nombre" placeholder="(Obligatorio)" value="<?php echo $nombre ?>" <?php echo $disable ?>>
                            </p>
                            <?php if(isset($errores["nombre"])) echo $errores["nombre"] ?>
                            <p>
                                <label for="idapellidos">Apellidos:</label>
                                <input type="text" id="idapellidos" name="apellidos" value="<?php echo $apellidos ?>" <?php echo $disable ?>>
                            </p>
                            <?php if(isset($errores["apellidos"])) echo $errores["apellidos"] ?>
                            <p>
                                <label for="fotografia">Fotografía:</label>
                                <input type="file" id="fotografia" name="fotografia">
                            </p>
                            <p>
                                <label for="dni">DNI:</label>
                                <input type="text" id="dni" name="dni" value="<?php echo $dni ?>" <?php echo $disable ?>>
                            </p>
                            <?php if(isset($errores["dni"])) echo $errores["dni"] ?>
                            <p>
                                <label for="nacimiento">F. nacimiento:</label>
                                <input type="date" id="nacimiento" name="fecha-nacimiento" value="<?php echo $fechaNacimiento ?>"  <?php echo $disable ?>>
                            </p>
                            <?php if(isset($errores["fecha-nacimiento"])) echo $errores["fecha-nacimiento"] ?>
                            <p>
                                <label for="idnacionalidad">Nacionalidad:</label>
                                <input type="text" id="idnacionalidad" name="nacionalidad" value="<?php echo $nacionalidad ?>" <?php echo $disable ?>>
                            </p>
                            <?php if(isset($errores["nacionalidad"])) echo $errores["nacionalidad"] ?>
                            <p>
                                <label id="sexo">Sexo:
                                <select name="sexo" <?php echo $disable ?>>
                                    <option <?php if($sexo == "Masculino") echo "selected"; ?>>Masculino</option>
                                    <option <?php if($sexo == "Femenino") echo "selected"; ?>>Femenino</option>
                                    <option <?php if($sexo == "No deseo responder") echo "selected"; ?>>No deseo responder</option>
                                </select></label>
                            </p>
                            <?php if(isset($errores["sexo"])) echo $errores["sexo"] ?>
                        </fieldset>
                        <fieldset class="datos-acceso">
                            <legend>Datos de acceso</legend>
                            <p>
                                <label for="idemail">E-mail:</label>
                                <input type="email" id="idemail" name="email" value="<?php echo $email ?>" <?php echo $disable ?>>
                            </p>
                            <?php if(isset($errores["email"])) echo $errores["email"] ?>
                            <p>
                                <label for="idclave">Clave de acceso:</label>
                                <input type="password" id="idclave" name="clave" value="<?php echo $clave ?>" placeholder="Introduzca una clave" <?php echo $disable ?>>
                            </p>
                            <?php if(isset($errores["clave"])) echo $errores["clave"] ?>
                            <p>
                                <label for="idclave2">Repita la clave:</label>
                                <input type="password" id="idclave2" name="clave-repetida" value="<?php echo $claveRepetida ?>" placeholder="Introduzca la misma clave" <?php echo $disable ?>>
                            </p>
                            <?php if(isset($errores["clave-repetida"])) echo $errores["clave-repetida"] ?>
                        </fieldset>
                        <fieldset class="preferencias">
                            <legend>Preferencias</legend>
                            <div id="idioma">
                                <p>Idioma para comunicaciones:</p>
                                <label><input type="radio" name="idioma-comunicacion" value="español" <?php if($idiomaComunicacion == "español") echo "checked"; ?> <?php echo $disable ?>/>Español</label>
                                <label><input type="radio" name="idioma-comunicacion" value="ingles" <?php if($idiomaComunicacion == "ingles") echo "checked"; ?> <?php echo $disable ?>/>Inglés</label>
                                <label><input type="radio" name="idioma-comunicacion" value="frances" <?php if($idiomaComunicacion == "frances") echo "checked"; ?> <?php echo $disable ?>/>Francés</label>
                                <?php if(isset($errores["idioma-comunicacion"])) echo $errores["idioma-comunicacion"] ?>
                            </div>
                            <div id="preferencia-habitacion">
                                <p>Preferencia de habitación:</p>
                                <label><input type="checkbox" name="preferencia[]" value="fumadores" <?php  if(in_array("fumadores", $preferencias)) echo "checked"; ?> <?php echo $disable ?>/>Para fumadores</label>
                                <label><input type="checkbox" name="preferencia[]" value="mascotas" <?php  if(in_array("mascotas", $preferencias)) echo "checked"; ?> <?php echo $disable ?>/>Que permita mascotas</label>
                                <label><input type="checkbox" name="preferencia[]" value="vistas" <?php  if(in_array("vistas", $preferencias)) echo "checked"; ?> <?php echo $disable ?>/>Con vistas</label>
                                <label><input type="checkbox" name="preferencia[]" value="moqueta" <?php  if(in_array("moqueta", $preferencias)) echo "checked"; ?> <?php echo $disable ?>/>Con moqueta</label>
                                <?php if(isset($errores["preferencia"])) echo $errores["preferencia"] ?>
                            </div>
                        </fieldset>
                        <p>
                            <label>Tratamiento de datos:
                                <select name="tratamiento" <?php echo $disable ?>>
                                    <option value="TOTAL" <?php if($tratamiento == "TOTAL") echo "selected"; ?>>Acepta el almacenamiento de mis datos y el envío a terceros</option>
                                    <option value="PARCIAL" <?php if($tratamiento == "PARCIAL") echo "selected"; ?>>Acepta el almacenamiento de mis datos pero no el envío a terceros</option>
                                    <option value="NINGUNO" <?php if($tratamiento == "NINGUNO") echo "selected"; ?>>No acepta el almacenamiento ni el envío de datos a terceros</option>
                                </select></label>
                        </p>
                        <?php if(isset($errores["tratamiento"])) echo $errores["tratamiento"] ?>
                        <div class="boton">
                            <input type="submit" value="<?php echo $submit ?>" name="submit" id="boton-enviar">
                        </div>
                    </form>
                </section>
            </main>
        </div>
    
        <aside class="zona-lateral">
            <!-- Creado de cara a la práctica final. Dejp la estructura, pero falta rellenar información -->
            <div class="inicio-sesion">
                <h2>Inicio de sesión y perfil de usuario</h2>
            </div>
            <section class="informacion-2nivel">
                <h2>Información de Interés (Información de Segundo Nivel)</h2>
                <ul>
                    <li><a href="">Info 1</a></li>
                    <li><a href="">Info 2</a></li>
                </ul>
            </section>
        </aside>
    </div>

    <footer>
        <!-- Creado de cara a la práctica final. Dejp la estructura, pero falta rellenar información -->
        <div class="fila">
            <div>
                <p>Información de autores</p>
            </div>
            <div>
                <p><a href="css-adaptable.pdf">Documentación CSS</a></p>
            </div>
            <div>
                <p>Copyright</p>
            </div>
        </div>
        <div class="contacto-reducido">
            <div class="fila">
                <img src="img/contacto.png" alt="Datos de Contacto">
            </div>
        </div>
    </footer>
</body>
</html>