<?php 
// Función para insertar un usuario
function insertar_usuario($conexion, $datos) {
    $query = <<<EOD
        INSERT INTO usuarios (nombre, apellidos, dni, fechanacimiento, nacionalidad, sexo, email, clave, idioma, preferencia, tratamientodatos) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);
    EOD;
    $stmt = $conexion->prepare($query);
    if (!$stmt) {
        // Si la preparación de la consulta falla, se puede manejar el error aquí
        echo "Error al preparar la consulta: " . $conexion->error;
        return false;
    }
    // Bind de los parámetros 
    $stmt->bind_param("sssssssssss", $datos['nombre'], $datos['apellidos'], 
    $datos['dni'], $datos['fecha-nacimiento'], $datos['nacionalidad'], 
    $datos['sexo'], $datos['email'], $datos['clave'], $datos['idioma-comunicacion'], 
    $datos['preferencia'], $datos['tratamiento']);
    // Ejecución de la consulta
    $resultado = $stmt->execute();
    if (!$resultado) {
        // Si la ejecución de la consulta falla, se puede manejar el error aquí
        echo "Error al ejecutar la consulta: " . $stmt->error;
        return false;
    }
    // Cierre de la consulta
    $stmt->close();
    return true;
}

// Funcion para obtener todos los usuarios
function obtener_usuarios($conexion) {
    $query = "SELECT * FROM usuarios";
    $resultado = $conexion->query($query);
    if (!$resultado) {
        // Si la ejecución de la consulta falla, se puede manejar el error aquí
        echo "Error al ejecutar la consulta: " . $conexion->error;
        return false;
    }
    return $resultado;
}

// Funcion para borrar un usuario dado su id
function borrar_usuario($conexion, $id) {
    $query = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conexion->prepare($query);
    if (!$stmt) {
        // Si la preparación de la consulta falla, se puede manejar el error aquí
        echo "Error al preparar la consulta: " . $conexion->error;
        return false;
    }
    // Bind de los parámetros
    $stmt->bind_param("i", $id);
    // Ejecución de la consulta
    $resultado = $stmt->execute();
    if (!$resultado) {
        // Si la ejecución de la consulta falla, se puede manejar el error aquí
        echo "Error al ejecutar la consulta: " . $stmt->error;
        return false;
    }
    // Cierre de la consulta
    $stmt->close();
    return true;
}


?>