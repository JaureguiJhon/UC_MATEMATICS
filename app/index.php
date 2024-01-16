<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matematics | Inicio</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <style>
        /* Estilos CSS adicionales para personalizar la página */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            font-size: 36px;
            margin-top: 40px;
            color: #333;
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

        /*
        nav a:hover {
            color: #abcf;
        }*/

        .container {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .left-box, .right-box {
            width: 50%;
            padding: 20px;
        }

        .left-box {
            background-color: #f2f2f2;
            text-align: center;
            padding: 40px;
        }

        .left-box h2 {
            font-size: 28px;
            color: #333;
        }

        .left-box p {
            font-size: 16px;
            color: #666;
        }

        .left-box button {
            background-color: #FF5733;
            color: #fff;
            font-size: 18px;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        .right-box {
            text-align: center; /* Centra horizontalmente el contenido en el contenedor */
        }
        .right-box img{
            width: auto;
            height: 500px;
        }
    </style>
</head>
<body>
    <div style="text-align: center; margin: 40px;">
        <h1 >Bienvenido a <span style="color: #FF5733;">MATEMATICS</span></h1>
    </div>
    <div class="nav-bar">
        <a class="active" href="index.php">Inicio</a>
        <!--<a href="about.php">Nosotros</a>-->
        <a href="register.php">Registro</a>
        <a href="login.php">Login</a>
    </div>
    <div class="container">
        <div class="left-box">
            <h2>El aliado estratégico que necesitas</h2>
            <p>Con IA generativa para ayudarte en tus tareas</p>
            <a href="register.php"><button>Registrar</button></a>
        </div>
        <div class="right-box">
            <img src="ImgIndex.png" alt="ImgIndx">
        </div>
    </div>
</body>
</html>
