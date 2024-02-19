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
    
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>MATEMATICS | Descubre lo Mejor</title>
        <link rel="stylesheet" href="./css/home.css">
        <link rel="stylesheet" href="./css/myStyles.css">
        <link rel="stylesheet" href="./css/estilo.css">
    </head>
    <body>
        <div>
            <div class="content-title">
                <h1><span style="color: #FF5733;">MATEMATICS</span></h1>
            </div>
            <nav class="nav-bar">
                <a href="about.php">Contactos</a>
                <a href="queries.php">Asesoria</a>
                <a class="active" href="home.php">Inicio</a>
                <div class="profile-button" id="profileButton"><?= strtoupper(substr($user_name, 0, 1)); ?></div>
                <div class="dropdown" id="dropdown">
                    <div class="dropdown-content">
                        <p><strong>Nombre:</strong> <?php echo $user_name; ?></p>
                        <p><strong>Correo:</strong> <?php echo $user_email; ?></p>
                        <button class="dropdown-button" id="logoutButton">Cerrar Sesión</button>
                    </div>
                </div>
            </nav>
        </div>
        <nav>
            <script>
                window.addEventListener('mouseover', initLandbot, { once: true });
                window.addEventListener('touchstart', initLandbot, { once: true });
                var myLandbot;
                function initLandbot() {
                if (!myLandbot) {
                    var s = document.createElement('script');s.type = 'text/javascript';s.async = true;
                    s.addEventListener('load', function() {
                    var myLandbot = new Landbot.Livechat({
                        configUrl: 'https://storage.googleapis.com/landbot.online/v3/H-2098746-WIHNYXJDH0ALRCXK/index.json',
                    });
                    });
                    s.src = 'https://cdn.landbot.io/landbot-3/landbot-3.0.0.js';
                    var x = document.getElementsByTagName('script')[0];
                    x.parentNode.insertBefore(s, x);
                }
                }
            </script>
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
            <h1 style="color:white">Bienvenido a <span style="color: #FF5733;">Matematics</span></h1>
            <p>Descubre lo mejor que tenemos para ti</p>
        </div>
        <div class="content">
            <div class="image-box">
                <img src="ImgIndex.png" alt="Estudiante de matemáticas">
            </div>
            <div class="text-box" style="overflow: auto; height:500px;">
                <h2>¿Para qué sirven las matemáticas?</h2>
                <p>
                    Las matemáticas sirven para muchas cosas en nuestra vida diaria. Por ejemplo, 
                    las usamos para:
                </p>
                <ul>
                    <li>Contar objetos</li>
                    <li>Medir y comparar cosas</li>  
                    <li>Entender formas y figuras</li>
                    <li>Resolver problemas</li>
                    <li>Jugar con números</li>
                    <li>Analizar información</li>
                    <li>Tomar buenas decisiones</li>
                </ul>
                <p>
                    Las matemáticas nos ayudan a pensar mejor y a entender el mundo a nuestro 
                    alrededor. ¡Son muy importantes e interesantes! Cuando aprendes matemáticas
                    estás desarrollando una habilidad muy valiosa.
                </p>
                <div class="video">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/Cwq4dRBWcr8" frameborder="0" allowfullscreen></iframe>
                    <div class="video-info">
                        <h3>¿Para qué sirven las matemáticas? Eduardo Sáenz de Cabezón, matemático</h3>
                    </div>
                    <p>En este vídeo, Eduardo Sáenz de Cabezón contagia su emoción por las matemáticas y explica por qué “somos seres matemáticos”</p>
                </div>
            </div>
            </div>
        </div>
        </div>
    </body>
</html>
