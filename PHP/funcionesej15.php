<?php

function validarDatos()
{
    // Inicializamos el array de errores
    $errores = array();
    // Inicializamos el array de datos
    $datos = array();

    // Si se ha enviado el formulario, comprobamos los datos
    if (isset($_GET['enviar']) && $_SERVER["REQUEST_METHOD"] == "GET") {
        // Comprobar que el nombre no es vacío 
        if (empty($_GET["nombre"])) {
            $errores["nombre"] = "<p class='error'>El nombre es obligatorio</p>";
            $datos["nombre"] = "";
        } else {
            // Comprobar que el nombre epieza por mayúsculas
            if (!preg_match("/^[A-Z][a-zA-Z]*$/", $_GET["nombre"])) {
                $errores["nombre"] = "<p class='error'>El nombre debe empezar por mayúsculas</p>";
                $datos["nombre"] = "";
            } else {
                $datos["nombre"] = $_GET["nombre"];
            }
        }

        // El apellido no es obligatorio, pero si se introduce, debe empezar por mayúsculas
        if (!empty($_GET["apellidos"])) {
            if (!preg_match("/^[A-Z][a-zA-Z]*$/", $_GET["apellidos"])) {
                $errores["apellidos"] = "<p class='error'>El apellido debe empezar por mayúsculas</p>";
                $datos["apellidos"] = "";
            } else {
                $datos["apellidos"] = $_GET["apellidos"];
            }
        } else {
            $datos["apellidos"] = "";
        }

        // El DNI es obligatorio y debe tener 8 dígitos y una letra mayúscula
        if (empty($_GET['dni'])) {
            $errores['dni'] = "<p class='error'>El DNI es obligatorio</p>";
            $datos['dni'] = "";
        } else {
            if (!preg_match("/^[0-9]{8}[A-Z]$/", $_GET["dni"])) {
                $errores['dni'] = "<p class='error'>El DNI debe tener 8 dígitos y una letra mayúscula</p>";
                $datos['dni'] = "";
            } else {
                $datos['dni'] = $_GET['dni'];
            }
        }

        // La fecha de nacimiento es obligatoria
        if (empty($_GET["fecha-nacimiento"])) {
            $errores["fecha-nacimiento"] = "<p class='error'>La fecha de nacimiento es obligatoria</p>";
            $datos["fecha-nacimiento"] = "";
        } else {
            // La persona debe ser mayor de edad
            $fechaActual = new DateTime();
            $datos["fecha-nacimiento"] = new DateTime($_GET["fecha-nacimiento"]);
            $edad = $fechaActual->diff($datos["fecha-nacimiento"]);
            if ($edad->y < 18) {
                $errores["fecha-nacimiento"] = "<p class='error'>Debes ser mayor de edad para registrarte</p>";
                $datos["fecha-nacimiento"] = "";
            } else {
                $datos["fecha-nacimiento"] = $_GET["fecha-nacimiento"];
            }
        }

        // No es obligatorio indicar la nacionalidad
        if (!empty($_GET["nacionalidad"])) {
            $datos["nacionalidad"] = $_GET["nacionalidad"];
        } else {
            $datos["nacionalidad"] = "";
        }

        // El sexo es obligatorio y debe ser uno de los 3 valores permitidos
        if (empty($_GET["sexo"])) {
            $errores["sexo"] = "<p class='error'>El sexo es obligatorio</p>";
            $datos["sexo"] = "No deseo responder";
        } else {
            if ($_GET["sexo"] != "Masculino" && $_GET["sexo"] != "Femenino" && $_GET["sexo"] != "No deseo responder") {
                $errores["sexo"] = "<p class='error'>El sexo debe ser Masculino, Femenino o No deseo responder</p>";
                $datos["sexo"] = "No deseo responder";
            } else {
                $datos["sexo"] = $_GET["sexo"];
            }
        }

        // El email es obligatorio y debe tener un formato válido
        if (empty($_GET["email"])) {
            $errores["email"] = "<p class='error'>El email es obligatorio</p>";
            $datos["email"] = "";
        } else {
            if (!filter_var($_GET["email"], FILTER_VALIDATE_EMAIL)) {
                $errores["email"] = "<p class='error'>El email no tiene un formato válido</p>";
                $datos["email"] = "";
            } else {
                $datos["email"] = $_GET["email"];
            }
        }

        // La clave es obligatoria y ha de coincidir con la clave repetida
        if (empty($_GET["clave"])) {
            $errores["clave"] = "<p class='error'>La clave es obligatoria</p>";
            $datos["clave"] = "";
            $datos["clave-repetida"] = "";
        } else {
            $datos["clave"] = $_GET["clave"];
            if (empty($_GET["clave-repetida"])) {
                $errores["clave-repetida"] = "<p class='error'>Debe repetir la clave</p>";
                $datos["clave-repetida"] = "";
            } else {
                $datos["clave-repetida"] = $_GET["clave-repetida"];
                if ($datos["clave"] != $datos["clave-repetida"]) {
                    $errores["clave-repetida"] = "<p class='error'>Las claves no coinciden</p>";
                    $datos["clave-repetida"] = "";
                }
            }
        }

        // El idioma de comunicación es obligatorio y debe ser uno de los 3 valores permitidos
        if (empty($_GET["idioma-comunicacion"])) {
            $errores["idioma-comunicacion"] = "<p class='error'>El idioma de comunicación es obligatorio</p>";
            $datos["idioma-comunicacion"] = "español";
        } else {
            if ($_GET["idioma-comunicacion"] != "español" && $_GET["idioma-comunicacion"] != "ingles" && $_GET["idioma-comunicacion"] != "frances") {
                $errores["idioma-comunicacion"] = "<p class='error'>El idioma de comunicación debe ser español, inglés o francés</p>";
                $datos["idioma-comunicacion"] = "español";
            } else {
                $datos["idioma-comunicacion"] = $_GET["idioma-comunicacion"];
            }
        }

        // La preferencia de habitación no es obligatoria, pero si se indica, debe ser uno de los 4 valores permitidos
        if (!empty($_GET["preferencia"])) {
            $datos["preferencias"] = array();
            foreach ($_GET["preferencia"] as $valor) {
                if (in_array($valor, array("fumadores", "mascotas", "vistas", "moqueta"))) {
                    $datos["preferencias"][] = $valor;
                }
            }
            $datos["preferencia"] = !empty($datos["preferencias"]) ? implode(',', $datos["preferencias"]) : '';
            if (empty($datos["preferencia"])) {
                $errores["preferencia"] = "<p class='error'>Las preferencias de habitación no son válidas</p>";
            }
        } else {
            $datos["preferencia"] = "";
            $datos["preferencias"] = array();
        }

        // El tratamiento de datos es obligatorio y debe ser uno de los 3 valores permitidos
        if (empty($_GET["tratamiento"])) {
            $errores["tratamiento"] = "<p class='error'>El tratamiento de datos es obligatorio</p>";
            $datos["tratamiento"] = "TOTAL";
        } else {
            if ($_GET["tratamiento"] != "TOTAL" && $_GET["tratamiento"] != "PARCIAL" && $_GET["tratamiento"] != "NINGUNO") {
                $errores["tratamiento"] = "<p class='error'>El tratamiento de datos debe ser TOTAL, PARCIAL o NINGUNO</p>";
                $datos["tratamiento"] = "TOTAL";
            } else {
                $datos["tratamiento"] = $_GET["tratamiento"];
            }
        }

        if (!empty($_GET["enviar"])){
            if (empty($errores)){
                $datos["correcto"] = true;
            }
        }
    }

    return [$errores, $datos];
}
