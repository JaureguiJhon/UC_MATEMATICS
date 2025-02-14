<?php
// Inicia la sesión (si no se ha iniciado ya)
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    // Si el usuario no ha iniciado sesión, redirige a la página de inicio de sesión
    header("Location: login.php");
    exit;
}
$servername = "localhost";
$username = "root";
$password = "";
$database = "matematics";

$conn = new mysqli($servername, $username, $password, $database);

// Verifica la conexión a la base de datos
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

// Obtiene la información del usuario activo

$user_id = $_SESSION['user_id'];
$query = "SELECT name, email FROM users WHERE id = $user_id";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $user_name = $user['name'];
    $user_email = $user['email'];
} else {
    // Manejo de error si no se encuentra al usuario
    // Puedes redirigir o mostrar un mensaje de error
}
// A partir de este punto, el usuario ha iniciado sesión y puede ver el contenido de home.php

// Resto del contenido de home.php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mathematics | Descubre lo Mejor</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <!-- Agrega Font Awesome para los iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="./css/myStyles.css">
    <link rel="stylesheet" href="./css/estilo.css">
    <style>
        /* Estilos CSS adicionales para personalizar la página */

        h1 {
            font-size: 36px;
        }
        .social-icons {
            list-style: none;
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .social-icons li {
            margin: 0 10px;
        }

        .social-icons a {
            color: #007BFF;
            font-size: 24px;
        }

        .social-icons a:hover {
            color: #0056b3;
        }
        .content{
            background-color: rgba(155, 154, 154, 0.8); /* Color de fondo con transparencia */
            border-radius: 30px; /* Bordes redondeados */
            padding: 20px; /* Espaciado interno para el contenido */
            box-shadow: 0 0 10px rgba(66, 66, 66, 0.2); /* Sombra suave */
            margin-left: 20px;
            margin-right: 20px;
        }
    </style>
</head>
<body>
    <div class="content-title">
        <h1><span style="color: #FF5733;">MATHEMATICS</span></h1>
    </div>
    <nav class="nav-bar">
        <a class="active" href="about.php">Conatactos</a>
        <a href="queries.php">Asesoria</a>
        <a href="home.php">Inicio</a>
        <div class="profile-button" id="profileButton"><?= strtoupper(substr($user_name, 0, 1)); ?></div>
        <div class="dropdown" id="dropdown">
            <div class="dropdown-content">
                <p><strong>Nombre:</strong> <?php echo $user_name; ?></p>
                <p><strong>Correo:</strong> <?php echo $user_email; ?></p>
                <button class="dropdown-button" id="logoutButton">Cerrar Sesión</button>
            </div>
        </div>
    </nav>
    <script>
        // JavaScript para mostrar y ocultar el menú desplegable
        const profileButton = document.getElementById("profileButton");
        const dropdown = document.getElementById("dropdown");
        const logoutButton = document.getElementById("logoutButton");

        profileButton.addEventListener("click", function(e) {
            e.stopPropagation(); // Evita que se cierre al hacer clic en el botón
            dropdown.style.display = "block";
        });

        logoutButton.addEventListener("click", function() {
            // Redirige al usuario a la página de cerrar sesión (ajusta la URL según tu configuración)
            window.location.href = "logout.php";
        });

        // Cierra el menú desplegable si se hace clic en otra parte de la página
        document.addEventListener("click", function(e) {
            if (e.target !== profileButton) {
                dropdown.style.display = "none";
            }
        });

        // Evita que se cierre al hacer clic dentro del menú desplegable
        dropdown.addEventListener("click", function(e) {
            e.stopPropagation();
        });
    </script>
    <div class="header">
        <h1 style="color:white">Buscas como realizar tus tareas...?</h1>
    </div>
    <div class="content">
        <h1 style='text-align: center;margin-bottom:200px'>CONTACTANOS</h1>
        
        <p style='text-align: center'><i class="fas fa-envelope"> contactos@mathematics.com</i></p>
        
        <ul class="social-icons">
            <li><a href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube"></i></a></li>
            <li><a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook"></i></a></li>
            <li><a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a></li>
            <li><a href="https://api.whatsapp.com/send?phone=" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
        </ul>
    </div>
</body>
</html>
