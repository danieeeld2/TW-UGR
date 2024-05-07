<?php
function generarFORM()
{ ?>
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
                        <?php if(isset($_SESSION["datos"]["correcto"])) echo "<h2 class='datos-recibidos'>Los datos se han recibido correctamente</h2>" ?>
                        <?php if(isset($_SESSION["datos"]["correcto"])) $disable = "disabled"; else $disable = ""; ?>
                        <h2>Registro de Usuarios</h2>
                        <form action="" method="get" novalidate>
                            <fieldset class="datos-personales">
                                <legend>Datos personales</legend>
                                <p>
                                    <label for="idnombre">Nombre:</label>
                                    <input type="text" id="idnombre" name="nombre" placeholder="(Obligatorio)" value="<?php if (isset($_SESSION["datos"]["nombre"])) echo $_SESSION["datos"]["nombre"] ?>" <?php echo $disable ?>>
                                </p>
                                <?php if (isset($_SESSION["errores"]["nombre"])) echo $_SESSION["errores"]["nombre"] ?>
                                <p>
                                    <label for="idapellidos">Apellidos:</label>
                                    <input type="text" id="idapellidos" name="apellidos" value="<?php if (isset($_SESSION["datos"]["apellidos"])) echo $_SESSION["datos"]["apellidos"] ?>" <?php echo $disable ?>>
                                </p>
                                <?php if (isset($_SESSION["errores"]["apellidos"])) echo $_SESSION["errores"]["apellidos"] ?>
                                <p>
                                    <label for="fotografia">Fotografía:</label>
                                    <input type="file" id="fotografia" name="fotografia">
                                </p>
                                <p>
                                    <label for="dni">DNI:</label>
                                    <input type="text" id="dni" name="dni" value="<?php if (isset($_SESSION["datos"]["dni"])) echo $_SESSION["datos"]["dni"]  ?>" <?php echo $disable ?>>
                                </p>
                                <?php if (isset($_SESSION["errores"]["dni"])) echo $_SESSION["errores"]["dni"] ?>
                                <p>
                                    <label for="nacimiento">F. nacimiento:</label>
                                    <input type="date" id="nacimiento" name="fecha-nacimiento" value="<?php if (isset($_SESSION["datos"]["fecha-nacimiento"])) echo $_SESSION["datos"]["fecha-nacimiento"] ?>" <?php echo $disable ?>>
                                </p>
                                <?php if (isset($_SESSION["errores"]["fecha-nacimiento"])) echo $_SESSION["errores"]["fecha-nacimiento"] ?>
                                <p>
                                    <label for="idnacionalidad">Nacionalidad:</label>
                                    <input type="text" id="idnacionalidad" name="nacionalidad" value="<?php if (isset($_SESSION["datos"]["nacionalidad"])) echo $_SESSION["datos"]["nacionalidad"] ?>" <?php echo $disable ?>>
                                </p>
                                <?php if (isset($_SESSION["errores"]["nacionalidad"])) echo $_SESSION["errores"]["nacionalidad"] ?>
                                <p>
                                    <label id="sexo">Sexo:
                                        <select name="sexo" <?php echo $disable ?>>
                                            <option <?php if (isset($_SESSION["datos"]["sexo"]) && $_SESSION["datos"]["sexo"] == "Masculino") echo "selected"; ?>>Masculino</option>
                                            <option <?php if (isset($_SESSION["datos"]["sexo"]) && $_SESSION["datos"]["sexo"] == "Femenino") echo "selected"; ?>>Femenino</option>
                                            <option <?php if (isset($_SESSION["datos"]["sexo"]) && $_SESSION["datos"]["sexo"] == "No deseo responder") echo "selected"; ?>>No deseo responder</option>
                                        </select></label>
                                </p>
                                <?php if (isset($_SESSION["errores"]["sexo"])) echo $_SESSION["errores"]["sexo"] ?>
                            </fieldset>
                            <fieldset class="datos-acceso">
                                <legend>Datos de acceso</legend>
                                <p>
                                    <label for="idemail">E-mail:</label>
                                    <input type="email" id="idemail" name="email" value="<?php if (isset($_SESSION["datos"]["email"])) echo $_SESSION["datos"]["email"] ?>" <?php echo $disable ?>>
                                </p>
                                <?php if (isset($_SESSION["errores"]["email"])) echo $_SESSION["errores"]["email"] ?>
                                <p>
                                    <label for="idclave">Clave de acceso:</label>
                                    <input type="password" id="idclave" name="clave" value="<?php if (isset($_SESSION["datos"]["clave"])) echo $_SESSION["datos"]["clave"] ?>" placeholder="Introduzca una clave" <?php echo $disable ?>>
                                </p>
                                <?php if (isset($_SESSION["errores"]["clave"])) echo $_SESSION["errores"]["clave"] ?>
                                <p>
                                    <label for="idclave2">Repita la clave:</label>
                                    <input type="password" id="idclave2" name="clave-repetida" value="<?php if (isset($_SESSION["datos"]["clave-repetida"])) echo $_SESSION["datos"]["clave-repetida"] ?>" placeholder="Introduzca la misma clave" <?php echo $disable ?>>
                                </p>
                                <?php if (isset($_SESSION["errores"]["clave-repetida"])) echo $_SESSION["errores"]["clave-repetida"] ?>
                            </fieldset>
                            <fieldset class="preferencias">
                                <legend>Preferencias</legend>
                                <div id="idioma">
                                    <p>Idioma para comunicaciones:</p>
                                    <label><input type="radio" name="idioma-comunicacion" value="español" <?php if (isset($_SESSION["datos"]["idioma-comunicacion"]) && $_SESSION["datos"]["idioma-comunicacion"] == "español") echo "checked"; ?> <?php echo $disable ?> />Español</label>
                                    <label><input type="radio" name="idioma-comunicacion" value="ingles" <?php if (isset($_SESSION["datos"]["idioma-comunicacion"]) && $_SESSION["datos"]["idioma-comunicacion"] == "ingles") echo "checked"; ?> <?php echo $disable ?> />Inglés</label>
                                    <label><input type="radio" name="idioma-comunicacion" value="frances" <?php if (isset($_SESSION["datos"]["idioma-comunicacion"]) && $_SESSION["datos"]["idioma-comunicacion"] == "frances") echo "checked"; ?> <?php echo $disable ?> />Francés</label>
                                    <?php if (isset($_SESSION["errores"]["idioma-comunicacion"])) echo $_SESSION["errores"]["idioma-comunicacion"] ?>
                                </div>
                                <div id="preferencia-habitacion">
                                    <p>Preferencia de habitación:</p>
                                    <label><input type="checkbox" name="preferencia[]" value="fumadores" <?php if (isset($_SESSION["datos"]["preferencias"]) && in_array("fumadores", $_SESSION["datos"]["preferencias"])) echo "checked"; ?> <?php echo $disable ?> />Para fumadores</label>
                                    <label><input type="checkbox" name="preferencia[]" value="mascotas" <?php if (isset($_SESSION["datos"]["preferencias"]) && in_array("mascotas", $_SESSION["datos"]["preferencias"])) echo "checked"; ?> <?php echo $disable ?> />Que permita mascotas</label>
                                    <label><input type="checkbox" name="preferencia[]" value="vistas" <?php if (isset($_SESSION["datos"]["preferencias"]) && in_array("vistas", $_SESSION["datos"]["preferencias"])) echo "checked"; ?> <?php echo $disable ?> />Con vistas</label>
                                    <label><input type="checkbox" name="preferencia[]" value="moqueta" <?php if (isset($_SESSION["datos"]["preferencias"]) && in_array("moqueta", $_SESSION["datos"]["preferencias"])) echo "checked"; ?> <?php echo $disable ?> />Con moqueta</label>
                                    <?php if (isset($_SESSION["errores"]["preferencia"])) echo $_SESSION["errores"]["preferencia"] ?>
                                </div>
                            </fieldset>
                            <p>
                                <label>Tratamiento de datos:
                                    <select name="tratamiento" <?php echo $disable ?>>
                                        <option value="TOTAL" <?php if (isset($_SESSION["datos"]["tratamiento"]) && $_SESSION["datos"]["tratamiento"] == "TOTAL") echo "selected"; ?>>Acepta el almacenamiento de mis datos y el envío a terceros</option>
                                        <option value="PARCIAL" <?php if (isset($_SESSION["datos"]["tratamiento"]) && $_SESSION["datos"]["tratamiento"] == "PARCIAL") echo "selected"; ?>>Acepta el almacenamiento de mis datos pero no el envío a terceros</option>
                                        <option value="NINGUNO" <?php if (isset($_SESSION["datos"]["tratamiento"]) && $_SESSION["datos"]["tratamiento"] == "NINGUNO") echo "selected"; ?>>No acepta el almacenamiento ni el envío de datos a terceros</option>
                                    </select></label>
                            </p>
                            <?php if (isset($_SESSION["errores"]["tratamiento"])) echo $_SESSION["errores"]["tratamiento"] ?>
                            <div class="boton">
                                <?php 
                                if(isset($_SESSION["datos"]["correcto"])){
                                    echo "<input type='submit' value='Confirmar Datos' name='confirmar' id='boton-enviar'>";
                                }
                                else echo "<input type='submit' value='Eviar Datos' name='enviar' id='boton-enviar'>";
                                ?>
                                
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
<?php } ?>