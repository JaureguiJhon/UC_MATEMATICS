<!-- reset_password_process.php -->
<?php
session_start();
require('includes/db.php'); // Asegúrate de incluir la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    
    // Verifica que las contraseñas coincidan
    if ($password === $confirm_password) {
        $reset_token = $_GET["token"]; // Obtén el token de la URL

        // Verifica el token en la base de datos
        $sql = "SELECT id FROM users WHERE reset_token = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $reset_token);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            // Restablece la contraseña
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET password = ?, reset_token = NULL WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $hashed_password, $user['id']);
            $stmt->execute();

            // Redirige al usuario a la página de inicio de sesión
            header("Location: login.php");
            exit;
        } else {
            // Token no válido, redirige a una página de error o a la página de inicio
            header("Location: index.php");
            exit;
        }
    } else {
        $error = "Las contraseñas no coinciden. Por favor, intenta de nuevo.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Restablecer Contraseña</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            /*min-height: 100vh;*/
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
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 20px;
            max-width: 400px;
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
        <h1 style="font-size: 36px"><span style="color: #FF5733;">matIAs</span></h1>
    </div>
    <div class="nav-bar">
        <a href="index.php">Inicio</a>
        <!--<a href="about.php">Nosotros</a>-->
        <a href="register.php">Registro</a>
        <a class="active" href="login.php">Login</a>
    </div>
    <h1>Restablecer Contraseña</h1>
    <p>Ingresa una nueva contraseña para tu cuenta.</p>
    
    <form method="post" action="login.php">
        <label for="nueva_contrasena">Nueva Contraseña:</label>
        <input type="password" name="nueva_contrasena" id="nueva_contrasena" required>
        
        <label for="confirmar_contrasena">Confirmar Contraseña:</label>
        <input type="password" name="confirmar_contrasena" id="confirmar_contrasena" required>
        
        <input type="hidden" name="email" value="<?php echo $email; ?>">
        
        <button type="submit">Guardar Contraseña</button>
    </form>
</body>
</html>
