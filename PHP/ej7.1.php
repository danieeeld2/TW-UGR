<?php 
    function validarFormulario(){
        $errores = [];
        if (empty($_GET['nombre'])){
            $errores['nombre'] = "<p class='error'>El campo nombre es obligatorio</p>";
        } else {
            if (!preg_match("/^[A-Z][a-zA-Z]*$/", $_GET['nombre'])){
                $errores['nombre'] = "<p class='error'>El nombre debe comenzar por mayúscula y contener solo letras</p>";
            }
        }
        if (!empty($_GET['apellidos'])){
            if (!preg_match("/^[A-Z][a-zA-Z]*$/", $_GET['apellidos'])){
                $errores['apellidos'] = "<p class='error'>Los apellidos deben comenzar por mayúscula y contener solo letras</p>";
            }
        }
        if (empty($_GET['dni'])){
            $errores['dni'] = "<p class='error'>El campo DNI es obligatorio</p>";
        } else {
            if (!preg_match("/^[0-9]{8}[A-Z]$/", $_GET['dni'])){
                $errores['dni'] = "<p class='error'>El DNI debe contener 8 dígitos y una letra mayúscula</p>";
            }
        }
        if (empty($_GET['fecha-nacimiento'])){
            $errores['fecha-nacimiento'] = "<p class='error'>El campo fecha de nacimiento es obligatorio</p>";
        } else {
            $fechaNacimiento = new DateTime($_GET['fecha-nacimiento']);
            $hoy = new DateTime();
            $edad = $hoy->diff($fechaNacimiento);
            if ($edad->y < 18){
                $errores['fecha-nacimiento'] = "<p class='error'>Debe ser mayor de edad para registrarse</p>";
            }
        }
        if (!in_array($_GET['sexo'], ['Masculino', 'Femenino', 'No deseo responder'])){
            $errores['sexo'] = "<p class='error'>El valor del campo sexo no es correcto</p>";
        }
        if (empty($_GET['email'])){
            $errores['email'] = "<p class='error'>El campo email es obligatorio</p>";
        } else {
            if (!filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)){
                $errores['email'] = "<p class='error'>El email no tiene un formato correcto</p>";
            }
        }
        if (empty($_GET['clave'])){
            $errores['clave'] = "<p class='error'>El campo clave es obligatorio</p>";
        } else {
            if ($_GET['clave'] != $_GET['clave-repetida']){
                $errores['clave-repetida'] = "<p class='error'>Las claves no coinciden</p>";
            }
        }
        if (empty($_GET['idioma-comunicacion'])){
            $errores['idioma-comunicacion'] = "<p class='error'>Debe seleccionar un idioma de comunicación</p>";
        } else {
            if (!in_array($_GET['idioma-comunicacion'], ['español', 'ingles', 'frances'])){
                $errores['idioma-comunicacion'] = "<p class='error'>El valor del campo idioma de comunicación no es correcto</p>";
            }
        }
        if(!empty($_GET['preferencia'])){
            foreach ($_GET['preferencia'] as $valor) {
                if (!in_array($valor, ['fumadores', 'mascotas', 'vistas', 'moqueta'])){
                    $errores['preferencia'] = "<p class='error'>El valor del campo preferencia de habitación no es correcto</p>";
                }
            }
        }
        if (!in_array($_GET['tratamiento'], ['TOTAL', 'PARCIAL', 'NINGUNO'])){
            $errores['tratamiento'] = "<p class='error'>El valor del campo tratamiento de datos no es correcto</p>";
        }

        return $errores;
    }

    function procesarError($campo, $errores){
        if (isset($errores[$campo])){
            if ($campo == "sexo") {
                return "No deseo responder";
            } else if ($campo == "idioma-comunicacion") {
                return "español";
            } else if ($campo == "tratamiento") {
                return "TOTAL";
            }
            return "";
        } else {
            return $_GET[$campo];
        }
    }

    function disabledCampo($errores) {
        if(count($errores) == 0 && isset($_GET['submit'])){
            return "disabled";
        } else {
            return "";
        }
    }

    function selectedCampo($campo, $valor){
        if ($campo == $valor){
            return "selected";
        } else {
            return "";
        }
    }

    function checkedCampo($campo, $valor){
        if ($campo == $valor){
            return "checked";
        } else {
            return "";
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['submit'])){
        $errores = validarFormulario();
        if (count($errores) == 0){
            $boton = "Confirmar datos";
            $texto_recibido = "<h2 class='datos-recibidos'>Los datos se han recibido correctamente</h2>";
        } else {
            $boton = "Enviar datos";
            $texto_recibido = "";
        }
        $nombre = procesarError('nombre', $errores);
        $apellidos = procesarError('apellidos', $errores);
        $dni = procesarError('dni', $errores);
        $fechaNacimiento = procesarError('fecha-nacimiento', $errores);
        $nacionalidad = $_GET['nacionalidad'];
        $email = procesarError('email', $errores);
        $clave = procesarError('clave', $errores);
        $claveRepetida = procesarError('clave-repetida', $errores);
        $sexo = procesarError('sexo', $errores);
        $idiomaComunicacion = procesarError('idioma-comunicacion', $errores);
        $tratamiento = procesarError('tratamiento', $errores);
        if(isset($errores['preferencia'])){
            $preferencias = [];
        } else {
            if(isset($_GET['preferencia'])){
                $preferencias = $_GET['preferencia'];
            } else {
                $preferencias = [];
            }
        }
    } else {
        $nombre = $apellidos = $dni = $fechaNacimiento = $nacionalidad = $email = $clave = $claveRepetida  =  "";
        $sexo = "No deseo responder";
        $idiomaComunicacion = "español";
        $preferencias = $errores = array();
        $tratamiento = "TOTAL";
        $boton = "Enviar datos";
        $texto_recibido = "";
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
                    <?php echo $texto_recibido; ?>
                    <h2>Registro de Usuarios</h2>
                    <form action="" method="get" novalidate>
                        <fieldset class="datos-personales">
                            <legend>Datos personales</legend>
                            <p>
                                <label for="idnombre">Nombre:</label>
                                <input type="text" id="idnombre" name="nombre" placeholder="(Obligatorio)" value="<?php echo $nombre ?>" <?php echo disabledCampo($errores) ?>>
                            </p>
                            <?php if (isset($errores['nombre'])) echo $errores['nombre']; ?>
                            <p>
                                <label for="idapellidos">Apellidos:</label>
                                <input type="text" id="idapellidos" name="apellidos" value="<?php echo $apellidos ?>" <?php echo disabledCampo($errores) ?>>
                            </p>
                            <?php if (isset($errores['apellidos'])) echo $errores['apellidos']; ?>
                            <p>
                                <label for="fotografia">Fotografía:</label>
                                <input type="file" id="fotografia" name="fotografia" <?php echo disabledCampo($errores) ?>>
                            </p>
                            <p>
                                <label for="dni">DNI:</label>
                                <input type="text" id="dni" name="dni" value="<?php echo $dni ?>" <?php echo disabledCampo($errores) ?>>
                            </p>
                            <?php if (isset($errores['dni'])) echo $errores['dni']; ?>
                            <p>
                                <label for="nacimiento">F. nacimiento:</label>
                                <input type="date" id="nacimiento" name="fecha-nacimiento" value="<?php echo $fechaNacimiento ?>" <?php echo disabledCampo($errores) ?>>
                            </p>
                            <?php if (isset($errores['fecha-nacimiento'])) echo $errores['fecha-nacimiento']; ?>
                            <p>
                                <label for="idnacionalidad">Nacionalidad:</label>
                                <input type="text" id="idnacionalidad" name="nacionalidad" value="<?php echo $nacionalidad ?>" <?php echo disabledCampo($errores) ?>>
                            </p>
                            <p>
                                <label id="sexo">Sexo:
                                <select name="sexo" <?php echo disabledCampo($errores) ?>>
                                    <option <?php echo selectedCampo($sexo, "Masculino") ?>>Masculino</option>
                                    <option <?php echo selectedCampo($sexo, "Femenino") ?>>Femenino</option>
                                    <option <?php echo selectedCampo($sexo, "No deseo responder") ?>>No deseo responder</option>
                                </select></label>
                            </p>
                            <?php if (isset($errores['sexo'])) echo $errores['sexo']; ?>
                        </fieldset>
                        <fieldset class="datos-acceso">
                            <legend>Datos de acceso</legend>
                            <p>
                                <label for="idemail">E-mail:</label>
                                <input type="email" id="idemail" name="email" value="<?php echo $email ?>" <?php echo disabledCampo($errores) ?>>
                            </p>
                            <?php if (isset($errores['email'])) echo $errores['email']; ?>
                            <p>
                                <label for="idclave">Clave de acceso:</label>
                                <input type="password" id="idclave" name="clave" placeholder="Introduzca una clave" value="<?php echo $clave ?>" <?php echo disabledCampo($errores) ?>>
                            </p>
                            <?php if (isset($errores['clave'])) echo $errores['clave']; ?>
                            <p>
                                <label for="idclave2">Repita la clave:</label>
                                <input type="password" id="idclave2" name="clave-repetida" placeholder="Introduzca la misma clave" value="<?php echo $claveRepetida ?>" <?php echo disabledCampo($errores) ?>>
                            </p>
                            <?php if (isset($errores['clave-repetida'])) echo $errores['clave-repetida']; ?>
                        </fieldset>
                        <fieldset class="preferencias">
                            <legend>Preferencias</legend>
                            <div id="idioma">
                                <p>Idioma para comunicaciones:</p>
                                <label><input type="radio" name="idioma-comunicacion" value="español" <?php echo checkedCampo($idiomaComunicacion, "español") ?> <?php echo disabledCampo($errores) ?>/>Español</label>
                                <label><input type="radio" name="idioma-comunicacion" value="ingles" <?php echo checkedCampo($idiomaComunicacion, "ingles") ?> <?php echo disabledCampo($errores) ?>/>Inglés</label>
                                <label><input type="radio" name="idioma-comunicacion" value="frances" <?php echo checkedCampo($idiomaComunicacion, "frances") ?> <?php echo disabledCampo($errores) ?>/>Francés</label>
                                <?php if (isset($errores['idioma-comunicacion'])) echo $errores['idioma-comunicacion']; ?>
                            </div>
                            <div id="preferencia-habitacion">
                                <p>Preferencia de habitación:</p>
                                <label><input type="checkbox" name="preferencia[]" value="fumadores" <?php  if(in_array("fumadores", $preferencias)) echo "checked"; ?> <?php echo disabledCampo($errores) ?>/>Para fumadores</label>
                                <label><input type="checkbox" name="preferencia[]" value="mascotas" <?php  if(in_array("mascotas", $preferencias)) echo "checked"; ?> <?php echo disabledCampo($errores) ?>/>Que permita mascotas</label>
                                <label><input type="checkbox" name="preferencia[]" value="vistas" <?php  if(in_array("vistas", $preferencias)) echo "checked"; ?> <?php echo disabledCampo($errores) ?>/>Con vistas</label>
                                <label><input type="checkbox" name="preferencia[]" value="moqueta" <?php  if(in_array("moqueta", $preferencias)) echo "checked"; ?> <?php echo disabledCampo($errores) ?>/>Con moqueta</label>
                                <?php if (isset($errores['preferencia'])) echo $errores['preferencia']; ?>
                            </div>
                        </fieldset>
                        <p>
                            <label>Tratamiento de datos:
                                <select name="tratamiento" <?php echo disabledCampo($errores) ?>>
                                    <option value="TOTAL" <?php echo selectedCampo($tratamiento, "TOTAL") ?>>Acepta el almacenamiento de mis datos y el envío a terceros</option>
                                    <option value="PARCIAL" <?php echo selectedCampo($tratamiento, "PARCIAL") ?>>Acepta el almacenamiento de mis datos pero no el envío a terceros</option>
                                    <option value="NINGUNO" <?php echo selectedCampo($tratamiento, "NINGUNO") ?>>No acepta el almacenamiento ni el envío de datos a terceros</option>
                                </select></label>
                        </p>
                        <?php if (isset($errores['tratamiento'])) echo $errores['tratamiento']; ?>
                        <div class="boton">
                            <input type="submit" value="<?php echo $boton ?>" name="submit" id="boton-enviar">
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