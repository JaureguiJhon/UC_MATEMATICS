<?php
session_start(); // Inicia la sesión (si no se ha iniciado ya)

// Verifica si el usuario está autenticado
if (isset($_SESSION['user_id'])) {
    // Destruye la sesión para cerrarla
    session_destroy();
    // Redirige al usuario a la página de inicio de sesión
    header("Location: login.php");
    exit;
} else {
    // Si el usuario no está autenticado, redirige a la página de inicio de sesión
    header("Location: login.php");
    exit;
}
?>
