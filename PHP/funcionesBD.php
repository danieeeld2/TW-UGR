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
    $datos['sexo'], $datos['email'], password_hash($datos['clave'], PASSWORD_DEFAULT), $datos['idioma-comunicacion'], 
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
        return null;
    }
    return $resultado;
}

// Funcion para obtener un usuario dado su id
function obtener_usuario($conexion, $id) {
    $query = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $conexion->prepare($query);
    if (!$stmt) {
        // Si la preparación de la consulta falla, se puede manejar el error aquí
        echo "Error al preparar la consulta: " . $conexion->error;
        return null;
    }
    // Bind de los parámetros
    $stmt->bind_param("i", $id);
    // Ejecución de la consulta
    $resultado = $stmt->execute();
    if (!$resultado) {
        // Si la ejecución de la consulta falla, se puede manejar el error aquí
        echo "Error al ejecutar la consulta: " . $stmt->error;
        return null;
    }
    // Devolver tupla
    $resultado = $stmt->get_result();
    $stmt->close();
    return $resultado->fetch_assoc();
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

// Funcion para modificar un usuario dado su id
function modificar_usuario($conexion, $datos, $id) {
    $query = <<<EOD
        UPDATE usuarios SET nombre = ?, apellidos = ?, dni = ?, fechanacimiento = ?, nacionalidad = ?, sexo = ?, email = ?, clave = ?, 
        idioma = ?, preferencia = ?, tratamientodatos = ? WHERE id = ?;
    EOD;
    $stmt = $conexion->prepare($query);
    if (!$stmt) {
        // Si la preparación de la consulta falla, se puede manejar el error aquí
        echo "Error al preparar la consulta: " . $conexion->error;
        return false;
    }
    // Bind de los parámetros
    $stmt->bind_param("sssssssssssi", $datos['nombre'], $datos['apellidos'], 
    $datos['dni'], $datos['fecha-nacimiento'], $datos['nacionalidad'], 
    $datos['sexo'], $datos['email'], password_hash($datos['clave'], PASSWORD_DEFAULT), $datos['idioma-comunicacion'], 
    $datos['preferencia'], $datos['tratamiento'], $id);

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

// Funcion para obtener el total de tuplas
function obtener_total_tuplas($conexion) {
    $query = "SELECT COUNT(*) as total FROM usuarios";
    $resultado = $conexion->query($query);
    if(!$resultado) {
        // Si la ejecución de la consulta falla, se puede manejar el error aquí
        echo "Error al ejecutar la consulta: " . $conexion->error;
        return null;
    }
    $total = $resultado->fetch_assoc();
    return $total['total'];
}

// Obtener usuarios paginados
function obtener_usuarios_paginados($conexion, $offset, $limit) {
    $query = "SELECT * FROM usuarios LIMIT ?, ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("ii", $offset, $limit);
    $stmt->execute();
    return $stmt->get_result();
}

?>