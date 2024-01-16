<?php
session_start(); // Inicia la sesión (si no se ha iniciado ya)

if (isset($_SESSION['user_id'])) {
    // El usuario ya está autenticado, redirige a la página de inicio (home.php) o a donde desees.
    header("Location: home.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root"; // Cambia esto si tienes un nombre de usuario diferente
    $password = ""; // Cambia esto si has configurado una contraseña
    $database = "matematics"; // Cambia esto si tu base de datos tiene un nombre diferente

    // Crea una conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $database);

    // Verifica la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $email = $_POST["email"];
    $password = $_POST["password"];

    // Consulta para verificar las credenciales
    $sql = "SELECT id, email, password FROM users WHERE email = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        // Las credenciales son válidas, establece la sesión de usuario
        $_SESSION['user_id'] = $user['id'];
        header("Location: home.php");
        exit;
    } else {
        // Las credenciales son incorrectas
        $error = "Credenciales incorrectas. Por favor, intenta de nuevo.";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matematics | Login</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <style>
        /* Estilos CSS para la página de inicio de sesión */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
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
            padding: 10px 20px;
            border-radius: 5px;
            transition: box-shadow 0.3s;
        }

        .nav-bar a:hover {
            box-shadow: 0 0 5px #000; /* Efecto de resaltado al pasar el cursor */
        }

        .nav-bar a.active {
            box-shadow: 0 0 5px #000; /* Efecto de resaltado para la opción activa */
        }

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
            margin: 40px auto;
        }

        h1 {
            font-size: 24px;
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 93%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button {
            display: block;
            width: 100%;
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px;
            font-size: 18px;
            border-radius: 3px;
            cursor: pointer;
            margin-top: 15px;
        }

        .register-link {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            margin-top: 10px;
        }

        .forgot-password-link {
            text-decoration: underline;
            color: #333;
            margin-top: 10px;
        }
        
    </style>
</head>
<body>
    <div style="text-align: center; margin: 40px;">
        <h1 style="font-size: 36px"><span style="color: #FF5733;">MATEMATICS</span></h1>
    </div>
    <div class="nav-bar">
        <a href="index.php">Inicio</a>
        <!--<a href="about.php">Nosotros</a>-->
        <a href="register.php">Registro</a>
        <a class="active" href="login.php">Login</a>
    </div>

    <div class="login-container">
        <h1>Iniciar Sesión en <span style="color: #78A490;">Matematics</span></h1>
        <form method="post" action="login.php">
            <label for="email">Correo Electrónico:</label>
            <input type="text" name="email" id="email" required>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required>
            <button type="submit" >Iniciar Sesión</button>
            <br>
        </form>
        <a class="register-link" href="register.php">¿No tienes una cuenta? Regístrate</a>
        <a class="forgot-password-link" href="reset_password_form.php">¿Olvidaste tu contraseña?</a>
    </div>
</body>
</html>
