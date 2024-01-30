<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    // Si el usuario no ha iniciado sesión, redirige a la página de inicio de sesión
    header("Location: login.php");
    exit;
}

// Conexión a la base de datos (ajusta los valores de acuerdo a tu configuración)
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
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>MATEMATICS | Generador de Recomendaciones de Marketing</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        h1 {
            font-size: 36px;
        }
        header {
            background-color: #007BFF;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        .container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"] {
            width: 97%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }

        .nav-bar {
            list-style: none;
            background-color: #abcf;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 0;
        }

        .nav-bar a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            font-size: 18px;
            border-radius: 5px;
            transition: box-shadow 0.3s;
            margin-right: 10px;
            padding: 10px 20px;
        }

        .nav-bar a:hover {
            box-shadow: 0 0 5px #000; /* Efecto de resaltado al pasar el cursor */
        }

        .nav-bar a.active {
            box-shadow: 0 0 5px #000; /* Efecto de resaltado para la opción activa */
        }

        .profile-button {
            cursor: pointer;
            background-color: #007BFF;
            color: #fff;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            text-align: center;
            line-height: 30px;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .profile-button:hover {
            background-color: #0056b3;
        }

        .dropdown {
            display: none;
            position: absolute;
            top: 50px;
            right: 10px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 200px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1;
            color: black;
            text-align: center;
        }
        
        .dropdown-content{
            padding:3px;
            margin:10px;
            border-top: 3px;
            font-size: 13px;
        }
        
        .dropdown-button {
            display: block;
            background-color: #fff;
            color: #007BFF;
            border: none;
            border-radius: 5px;
            margin: 10px 44px;
            padding: 10px 0;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            
        }

        .dropdown-button:hover {
            background-color: #f0f0f0;
        }

        .profile-dropdown {
            display: none;
            position: absolute;
            top: 60px;
            right: 10px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 200px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        .profile-dropdown-item:hover {
            background-color: #f0f0f0;
        }
        
        .response-box {
        text-align: center;
        margin-top: 20px;
        }

        .response-input {
        width: 97%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        }

        .form-column > div {
            flex-basis: 48%;
        }
        
        .form-column {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }
        .video-container {
            display: flex;
            flex-wrap: wrap;
        }

        .video {
            flex: 1 1 400px;
            margin: 10px;
        }

        .video-info {
            padding: 10px;
        }
 
        .video-info h3 {
            margin-top: 0;
        }
        .materials {
            margin: 40px 0;
        }

        .materials-list a {
            display: block;
            margin: 10px 0;
            color: #007bff;
            text-decoration: none;
        }

        .materials-list a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div style="text-align: center; margin: 30px;">
        <h1><span style="color: #FF5733;">MATEMATICS</span></h1>
    </div>
    <nav class="nav-bar">
        <a href="about.php">Conatactos</a>
        <a class="active" href="queries.php">Asesoria</a>
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
    <div class="container">
        <div class="response-box">
            <h2>Videos Educativos</h2>
            <div class="video-container">
                <div class="video">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/YFtEaVw5k1A" frameborder="0" allowfullscreen></iframe>
                    <div class="video-info">
                        <h3>Título del Video</h3>
                    </div>
                    <p>Breve descripción del contenido del video...</p>
                </div>

                <div class="video">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/DLwMMeSh67k" frameborder="0" allowfullscreen></iframe>
                    <div class="video-info">
                        <h3>Otro Título de Video</h3>
                        <p>Otra breve descripción...</p> 
                    </div>
                </div>
                
                <div class="video">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/KyjjFYM8aUg" frameborder="0" allowfullscreen></iframe>
                    <div class="video-info">
                        <h3>Título del Video</h3>
                        <p>Breve descripción del contenido del video...</p>
                    </div>
                </div>

                <div class="video">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/F-cOiXYBBSw" frameborder="0" allowfullscreen></iframe>
                    <div class="video-info">
                        <h3>Título del Video</h3>
                        <p>Breve descripción del contenido del video...</p>
                    </div>
                </div>
            </div>
            <div class="materials" style="background-color: #D4E7DE">
                <h2>Materiales de Estudio</h2>

                <div class="materials-list">
                    <?php $basePath = "/Matemátics";?>
                    <a href="<?php echo $basePath; ?>/app/files/05cuadradosmagicos.pdf" target="_blank">Cuadros Magicos</a>
                    <a href="<?php echo $basePath; ?>/app/files/Ejercicios_Graficos_Circulares_y_Pictogramas.pdf" target="_blank">Ejercicios de Graficos Circulares y Pictogramas</a>
                    <a href="<?php echo $basePath; ?>/app/files/Ejercicios-de-Ordenamiento-Circular-para-Quinto-de-Primaria.pdf" target="_blank">Ejercicios de Ordenamiento Circular</a>
                    <a href="<?php echo $basePath; ?>/app/files/Palitos-de-Fósforo-para-Cuarto-de-Primaria.pdf" target="_blank">Ejercicios de Palitos de fósforo</a>
                    <a href="<?php echo $basePath; ?>/app/files/Sucesos-Probables-e-Improbables-para-Cuarto-de-Primaria.pdf" target="_blank">Sucesos Problables e Improbables</a>
                </div>
            </div>
        </div>
    </div>
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
</body>
</html>