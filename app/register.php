<?php
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

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Cifra la contraseña
    $preguntaSeguridad = $_POST["pregunta_seguridad"];
    $respuestaSeguridad = $_POST["respuesta_seguridad"];

    // Inserta el registro en la tabla de usuarios
    $sql = "INSERT INTO users (name, email, password, pregunta_seguridad, respuesta_seguridad) VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $email, $password, $preguntaSeguridad, $respuestaSeguridad);

    if ($stmt->execute()) {
        echo "Usuario registrado correctamente.";
        // Puedes redirigir al usuario a la página de inicio de sesión aquí
    } else {
        echo "Error al registrar el usuario: " . $stmt->error;
    }

    /*
    $stmt->close();
    $conn->close();*/
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matematics | Registro</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
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

        .register-container {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            width: 400px;
            margin: 40px auto;
        }

        .register-container h1 {
            text-align: center;
            font-size: 24px;
            color: #333;
        }

        .register-container p.error {
            color: #FF5733;
            text-align: center;
        }

        .register-container form {
            display: flex;
            flex-direction: column;
        }

        .register-container label {
            font-weight: bold;
            margin-top: 10px;
        }

        .register-container input {
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .register-container button {
            background-color: #FF5733;
            color: #fff;
            font-size: 18px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .register-container{
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            
        }
        .login-link{
            text-decoration: none;
            color: #333;
            font-weight: bold;
            margin-top: 50px;
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
        <a class="active" href="register.php">Registro</a>
        <a href="login.php">Login</a>
    </div>

    <div class="register-container">
        <h1>Regístrate en <span style="color: #FF5733;">matIAs</span></h1>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <form method="post" action="register.php">
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" required>
            <label for="email">Correo Electrónico:</label>
            <input type="text" name="email" id="email" required>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required>
            <label for="pregunta_seguridad">Pregunta de Seguridad:</label>
            <input type="text" name="pregunta_seguridad" id="pregunta_seguridad" required>
            <label for="respuesta_seguridad">Respuesta de Seguridad:</label>
            <input type="text" name="respuesta_seguridad" id="respuesta_seguridad" required>
            <button type="submit" href="login.php">Registrarse</button>
            <br>
        </form>
        <a class="login-link" href="login.php">¿Ya tienes una cuenta? Iniciar Sesión</a>
    </div>
</body>
</html>
