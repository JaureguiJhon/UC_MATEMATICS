<?php
session_start();
require('./includes/db.php'); // Asegúrate de incluir la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $respuesta_seguridad = $_POST["respuesta_seguridad"];

    // Verifica el correo electrónico y la respuesta de seguridad
    $sql = "SELECT id, email, respuesta_seguridad FROM users WHERE email = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && $respuesta_seguridad == $user['respuesta_seguridad']) {
        // Verifica si se envió una nueva contraseña
        if(isset($_POST["new_password"]) && !empty($_POST["new_password"])) {
            // Actualiza la contraseña en la base de datos
            $new_password = password_hash($_POST["new_password"], PASSWORD_DEFAULT); // Hash de la nueva contraseña
            $sql_update = "UPDATE users SET password = ? WHERE id = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("si", $new_password, $user['id']);
            $stmt_update->execute();
            
            // Redirige al usuario a una página de confirmación
            header("Location: login.php");
            exit;
        } else {
            $error = "Por favor, ingresa una nueva contraseña.";
        }
    } else {
        $error = "Correo electrónico o respuesta de seguridad incorrectos. Por favor, intenta de nuevo.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matematics | Recuperación de Contraseña</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <style>
        /* Estilos CSS para la página de recuperación de contraseña */
        body {
            font-family: 'Arial', sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            /*min-height: 100vh;*/
        }

        .container {
            background-color: #fff;
            width: 70%;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-top:20px;
        }

        h1 {
            font-size: 36px;
            color: #333;
        }

        p {
            font-size: 18px;
            color: #555;
            margin: 20px 0;
        }

        form {
            text-align: left;
        }

        label {
            display: block;
            font-size: 18px;
            color: #333;
            margin-top: 10px;
        }

        input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 5px;
        }

        button {
            background-color: #FF5733;
            color: #fff;
            border: none;
            padding: 15px 40px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            margin-top: 20px;
        }

        button:hover {
            background-color: #FF4500;
        }
        .nav-bar {
            background-color: #333;
            color: #fff;
            display: flex;
            width: 100%;
            align-items: center;
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
    </style>
</head>
<body>
    <div style  z="text-align: center; margin: 40px;">
        <h1 style="font-size: 36px"><span style="color: #FF5733;">MATEMATICS</span></h1>
    </div>
    <div class="nav-bar">
        <a href="index.php">Inicio</a>
        <a href="register.php">Registro</a>
        <a class="active" href="login.php">Login</a>
    </div>
    <div class="container">
        <h1>Recuperación de Contraseña</h1>
        <?php if(isset($error)) { ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php } ?>
        <form method="post" action="reset_password_form.php">
            <label for="email">Correo Electrónico:</label>
            <input type="email" name="email" id="email" required>
            
            <label for="respuesta_seguridad">Respuesta de Seguridad:</label>
            <input type="text" name="respuesta_seguridad" id="respuesta_seguridad" required>
            
            <label for="new_password">Nueva Contraseña:</label>
            <input type="password" name="new_password" id="new_password" required>
            
            <button type="submit">Recuperar Contraseña</button>
        </form>
    </div>
    <!-- <div class="container">
        <h1>Recuperación de Contraseña</h1>
        <p>Ingresa tu dirección de correo electrónico y respuesta de seguridad para recuperar tu contraseña.</p>
        <form method="post" action="reset_password_form.php">
            <label for="email">Correo Electrónico:</label>
            <input type="email" name="email" id="email" required>
            
            <label for="respuesta_seguridad">Respuesta de Seguridad:</label>
            <input type="text" name="respuesta_seguridad" id="respuesta_seguridad" required>
            
            <button type="submit">Recuperar Contraseña</button>
        </form>
    </div> -->
</body>
</html>

