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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/queries.css">
    <link rel="stylesheet" href="./css/myStyles.css">
    <link rel="stylesheet" href="./css/estilo.css">
    <link rel="stylesheet" href="./css/game.css">
</head>
<body>
    <div class="content-title">
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
    </nav>
    <div class="content">
        <div class="response-box">
            <h2>Videos Educativos</h2>
            <!-- VIDEOS -->
            <div class="video-container">
                <div class="video">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/YFtEaVw5k1A" frameborder="0" allowfullscreen></iframe>
                    <div class="video-info">
                        <h3>Aprendiendo a multiplicar. La Multiplicación</h3>
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
            <!-- MATERIALES DE ESTUDIO -->
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
    <div class="content" style="justify-content: center;align-items: center; padding-left: 70px;">
        <div class="response-box">
            <div class="materials">
                <div class="container-game" >
                    <h2>Ejercicios de Operaciones Matemáticas</h2>
                    <section class="container-operadores">
                        <button id="suma" onclick="btnSumar()">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                        <button id="resta" onclick="btnResta()">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                        <button id="producto" onclick="btnProducto()">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                        <button id="division" onclick="btnDivision()">
                            <i class="fa-solid fa-divide"></i>
                        </button>
                    </section>
            
                    <section class="container-operacion">
                        <span id="num1"></span>
                        <span id="operacion"></span>
                        <span id="num2"></span>
                        <span> = </span>
                        <input type="text" id="respuesta_usuario">
                        <button id="corregir" style="color: black;" onclick="corregir()">Corregir</button>
            
                    </section>
            
                    <section id="msj_correccion">
            
                    </section>

                </div>
            </div>
        </div>
        <div class="contentSud">
            <h1>Sudoku</h1>
            <hr>
            <h2 id="errors">0</h2>

            <!-- 9x9 board -->
            <div id="board" style="justify-content: center;align-items: center;"></div>
            <br>
            <div id="digits">
            </div>
        </div>
    </div>
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
    <script>
        var numSelected = null;
        var tileSelected = null;
        
        var errors = 0;
        
        var board = [
            "--74916-5",
            "2---6-3-9",
            "-----7-1-",
            "-586----4",
            "--3----9-",
            "--62--187",
            "9-4-7---2",
            "67-83----",
            "81--45---"
        ]
        
        var solution = [
            "387491625",
            "241568379",
            "569327418",
            "758619234",
            "123784596",
            "496253187",
            "934176852",
            "675832941",
            "812945763"
        ]

        window.onload = function() {
            setGame();
        }

        function setGame() {
            // Digits 1-9
            for (let i = 1; i <= 9; i++) {
                //<div id="1" class="number">1</div>
                let number = document.createElement("div");
                number.id = i
                number.innerText = i;
                number.addEventListener("click", selectNumber);
                number.classList.add("number");
                document.getElementById("digits").appendChild(number);
            }

            // Board 9x9
            for (let r = 0; r < 9; r++) {
                for (let c = 0; c < 9; c++) {
                    let tile = document.createElement("div");
                    tile.id = r.toString() + "-" + c.toString();
                    if (board[r][c] != "-") {
                        tile.innerText = board[r][c];
                        tile.classList.add("tile-start");
                    }
                    if (r == 2 || r == 5) {
                        tile.classList.add("horizontal-line");
                    }
                    if (c == 2 || c == 5) {
                        tile.classList.add("vertical-line");
                    }
                    tile.addEventListener("click", selectTile);
                    tile.classList.add("tile");
                    document.getElementById("board").append(tile);
                }
            }
        }

        function selectNumber(){
            if (numSelected != null) {
                numSelected.classList.remove("number-selected");
            }
            numSelected = this;
            numSelected.classList.add("number-selected");
        }

        function selectTile() {
            if (numSelected) {
                if (this.innerText != "") {
                    return;
                }

                // "0-0" "0-1" .. "3-1"
                let coords = this.id.split("-"); //["0", "0"]
                let r = parseInt(coords[0]);
                let c = parseInt(coords[1]);

                if (solution[r][c] == numSelected.id) {
                    this.innerText = numSelected.id;
                }
                else {
                    errors += 1;
                    document.getElementById("errors").innerText = errors;
                }
            }
        }


    </script>
    <script>
        //seleccionamos los elementos del DOM
        let num1 = document.querySelector("#num1");
        let num2 = document.querySelector("#num2");
        let respuesta_usuario = document.querySelector("#respuesta_usuario");
        let msj_correccion = document.querySelector("#msj_correccion");
        let operacion = document.querySelector("#operacion");
        let operacion_actual;
        //en n1 y n2 voy a guardar los numeros aletarios de cada operacion
        let n1, n2;

        //funcion suma
        function btnSumar() {
            //limpiamos el div contenedor de las correcciones
            msj_correccion.innerHTML = "";
            //agregamos la clase activa al boton suma y la quitamos del resto
            activarBoton("suma");
            operacion_actual = "+";
            //asignamos la operacion suma a la etiqueta
            operacion.innerHTML = " + ";
            //generamos los numeros aletarios de la suma
            nuevaSuma();
        }

        function nuevaSuma() {
            //generamos dos numeros aletarios entre 0 y 9
            n1 = parseInt(Math.random() * 50);
            n2 = parseInt(Math.random() * 50);
            //asignamos los numeros a las etiquetas
            num1.innerHTML = n1;
            num2.innerHTML = n2;
            //colocamos el curso en el input
            respuesta_usuario.focus();
        }

        //Funcion producto
        function btnProducto() {
            //limpiamos el div contenedor de las correcciones
            msj_correccion.innerHTML = "";
            //agregamos la clase activa al boton producto y la quitamos del resto
            activarBoton("producto");
            operacion_actual = "*";
            //asignamos la operacion suma a la etiqueta
            operacion.innerHTML = " x ";
            //generamos los numeros aletarios de la suma
            nuevoProducto();
        }

        function nuevoProducto() {
            //generamos dos numeros aletarios entre 0 y 9
            n1 = parseInt(Math.random() * 100);
            n2 = parseInt(Math.random() * 10);
            //asignamos los numeros a las etiquetas
            num1.innerHTML = n1;
            num2.innerHTML = n2;
            //colocamos el curso en el input
            respuesta_usuario.focus();
        }

        //funcion resta
        function btnResta() {
            //limpiamos el div contenedor de las correcciones
            msj_correccion.innerHTML = "";
            //agregamos la clase activa al boton suma y la quitamos del resto
            activarBoton("resta");
            operacion_actual = "-";
            //asignamos la operacion suma a la etiqueta
            operacion.innerHTML = " - ";
            //generamos los numeros aletarios de la suma
            nuevaResta();
        }

        function nuevaResta() {
            //generamos dun numeros aletarios entre 0-100
            n1 = parseInt(Math.random() *  100 );
            //generamos un numero aleatorio entre 0-n1
            n2 = parseInt(Math.random() * n1);
            //asignamos los numeros a las etiquetas
            num1.innerHTML = n1;
            num2.innerHTML = n2;
            //colocamos el curso en el input
            respuesta_usuario.focus();
        }

        //funcion división
        function btnDivision() {
            //limpiamos el div contenedor de las correcciones
            msj_correccion.innerHTML = "";
            //agregamos la clase activa al boton suma y la quitamos del resto
            activarBoton("division");
            operacion_actual = "/";
            //asignamos la operacion suma a la etiqueta
            operacion.innerHTML = " / ";
            //generamos los numeros aletarios de la suma
            nuevaDivision();
        }

        function nuevaDivision() {
            //aqui voy a guardar los divisores del numero a dividr
            let divisores = [];

            //generamos un numero aletorio entre 1 y 10
            n1 = parseInt(Math.random() * 99 + 1);

            //encontramos los divisores del numero generado y lo guardamos en el arreglo
            for (var i = 1; i <= n1; i++) {
                if (n1 % i === 0) { //es divisor
                    divisores.push(i);
                }
            }

            //seleccionamos un posiciòn aleatorio de los numeros que son divisores
            let pos = parseInt(Math.random() * (divisores.length));

            n2 = divisores[pos];
            num1.innerHTML = n1;
            num2.innerHTML = n2;
            respuesta_usuario.focus();
        }

        //funcion que controla si la respuesta es correcta
        function corregir() {
            //si el usuario no ha ingresado nada no continuo
            if (respuesta_usuario.value == "") {
                return;
            }

            let solucion;
            //armo la operacion que se genero en una variable y veo cual es su reslutado
            //En este caso el operador + es para concatener las cadenas
            let operacion = n1 + operacion_actual + n2;
            solucion = eval(operacion);

            //creo un elemento i para agregar el icono de correcto o incorrecto
            var i = document.createElement("i");
            //controlo si coincide lo que el usuario respondio con la solucion
            if (respuesta_usuario.value == solucion) {
                i.className = "fa-regular fa-face-grin";
            } else {
                i.className = "fa-regular fa-face-frown";
            }

            //agrego el elemento al contenedor de las correciones
            msj_correccion.appendChild(i);

            //controlo que tipo de operacion estoy para genera una nueva operacion
            if (operacion_actual == "+") {
                nuevaSuma();
            } else if (operacion_actual == "-") {
                nuevaResta();
            } else if (operacion_actual == "*") {
                nuevoProducto();
            } else if (operacion_actual == "/") {
                nuevaDivision();
            }

            //limpio el input
            respuesta_usuario.value = "";
        }

        //agrego al input el evento onkeydown para detectar cuando se presiona Enter Y 
        //llamar directamente a la funcion corregir()
        respuesta_usuario.onkeydown = function(e) {
            var ev = document.all ? window.event : e;
            if (ev.keyCode == 13) {
                corregir();
            }
        }


        //Esta funcion la creamos luego, cuando tengamos listo los estilos
        function activarBoton(idBoton) {
            document.getElementById("suma").className = "";
            document.getElementById("resta").className = "";
            document.getElementById("producto").className = "";
            document.getElementById("division").className = "";
            document.getElementById(idBoton).className = "activado";
        }
    </script>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>
</html>