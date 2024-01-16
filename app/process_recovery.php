<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $respuestaSeguridad = $_POST["respuesta_seguridad"];

    // Realiza la validación de la respuesta de seguridad con la base de datos
    if (verificarRespuestaSeguridad($email, $respuestaSeguridad)) {
        // La respuesta de seguridad es correcta, permite al usuario restablecer la contraseña
        header("Location: update_pass.php");
        exit;
        // Implementa el código necesario para el restablecimiento de contraseña aquí
    } else {
        // La respuesta de seguridad es incorrecta, muestra un mensaje de error al usuario
        $response = array("message" => "La respuesta de seguridad es incorrecta. Por favor, intenta de nuevo.");
        echo json_encode($response);
        header("Location: reset_password_form.php");
        exit;
    }
}

// Función para verificar la respuesta de seguridad en la base de datos de XAMPP
function verificarRespuestaSeguridad($email, $respuestaSeguridad) {
    $db = new mysqli('localhost', 'root', '', 'matias'); // Ajusta los detalles de tu base de datos
    if ($db->connect_error) {
        die("Error de conexión: " . $db->connect_error);
    }

    // Consulta para verificar la respuesta de seguridad en la base de datos
    $query = "SELECT * FROM users WHERE email = ? AND respuesta_seguridad = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $email, $respuestaSeguridad);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        return true; // La respuesta de seguridad es correcta
    } else {
        return false; // La respuesta de seguridad es incorrecta
    }
    /*
    $stmt->close();
    $db->close();*/
}
?>

