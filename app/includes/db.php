<?php
$servername = "localhost";
$username = "root"; // Cambia esto si tienes un nombre de usuario diferente
$password = ""; // Cambia esto si has configurado una contraseña
$database = "matIAs"; // Cambia esto si tu base de datos tiene un nombre diferente

// Crea una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Datos del usuario
$email = "tuemail@example.com"; // Cambia esto a tu correo electrónico
$password = password_hash("tupasswordseguro", PASSWORD_DEFAULT); // Cambia esto a tu contraseña segura
$respuestaSeguridad = "Tu respuesta de seguridad"; // Cambia esto a la respuesta de seguridad que desees

// Inserta el registro en la tabla de usuarios
$sql = "INSERT INTO users (email, password, respuesta_seguridad) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $email, $password, $respuestaSeguridad);

if ($stmt->execute()) {
    echo "Registro de usuario insertado correctamente.";
} else {
    echo "Error al insertar el registro: " . $stmt->error;
}
/*
$stmt->close();
$conn->close();*/
?>
