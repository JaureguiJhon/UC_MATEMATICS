<?php
// router.php
if (isset($_GET['page'])) {
    $page = $_GET['page'];

    switch ($page) {
        case 'login':
            require_once('login.php');
            break;
        case 'register':
            require_once('register.php');
            break;
        case 'home':
            require_once('home.php');
            break;
        case 'about':
            require_once('about.php');
            break;
        case 'queries':
            require_once('queries.php');
            break;
        case 'forgot_password':
            require_once('forgot_password.php');
            break;
        case 'reset_password_form':
            require_once('reset_password_form.php');
            break;
        case 'recover_account':
            require_once('recover_account.php');
            break;
        case 'process_recovery':
            require_once('process_recovery.php');
            break;
        case 'logout': // Nueva entrada para el cierre de sesión
            require_once('controllers/logoutController.php'); // Incluye el controlador del cierre de sesión
            break;
        default:
            require_once('index.php');
            break;
    }
} else {
    require_once('controllers/indexController.php');
}
