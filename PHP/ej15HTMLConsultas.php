<?php
function generarTabla()
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
                <li><a href="ej15.php">Reservas</a></li>
                <li><a href="ej15Consultas.php">Consultas</a></li>
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
                <div class="ejercicio15">
                <?php 
                    if(isset($_SESSION["usuarios"]) && $_SESSION["usuarios"] != null){
                        echo "<table border='1'>";
                        echo "<tr><th>Nombre</th><th>Apellidos</th><th>DNI</th><th>Fecha de Nacimiento</th><th>Nacionalidad</th><th>Sexo</th><th>Email</th><th>Clave</th><th>Idioma</th><th>Preferencia</th><th>Tratamiento de Datos</th><th>Borrar</th><th>Modificar</th></tr>";
                        while($fila = $_SESSION["usuarios"]->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $fila["Nombre"] . "</td>";
                            echo "<td>" . $fila["Apellidos"] . "</td>";
                            echo "<td>" . $fila["DNI"] . "</td>";
                            echo "<td>" . $fila["FechaNacimiento"] . "</td>";
                            echo "<td>" . $fila["Nacionalidad"] . "</td>";
                            echo "<td>" . $fila["Sexo"] . "</td>";
                            echo "<td>" . $fila["Email"] . "</td>";
                            echo "<td>" . $fila["Clave"] . "</td>";
                            echo "<td>" . $fila["Idioma"] . "</td>";
                            echo "<td>" . $fila["Preferencia"] . "</td>";
                            echo "<td>" . $fila["TratamientoDatos"] . "</td>";
                            echo "<form action='' method='post'>";
                            echo "<input type='hidden' name='id' value='" . $fila["id"] . "'>";
                            echo "<td><input type='submit' name='borrar' value='Borrar'></td>";
                            echo "<td><input type='submit' name='modificar' value='Modificar'></td>";
                            echo "</form>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "<p>No hay usuarios registrados</p>";
                    }
                ?>
                </div>
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