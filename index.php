<?php
include 'config.php';

// Ouverture et paramètrage de session
session_cache_limiter("private, must-revalidate");
session_start();

session_regenerate_id(true);
setcookie(session_name(), session_id(), time() + $time_store_cookie,'/', null, null, true);

setlocale(LC_ALL, $locale);

// Include des focntions et de la bdd
include INC.'connexion.php';

include 'inc/tools.php';

$page = (isset($_GET['page'])) ? $_GET['page'] : 'accueil';


switch ($page) {
    default:
    case 'accueil' :
        $file = 'accueil.php';
        break;
    case 'catalogue' :
        $file = 'catalogue.php';
        break;
    case 'magazine' :
        $file = 'magazine.php';
        break;
    case 'contact' :
        $file = 'contact.php';
        break;
    case 'search' :
        $file = 'search.php';
        break;
    case 'newsletter' :
        $file = 'newsletter.php';
        break;
    case 'connect' :
        $file = 'connect.php';
        break;
    case 'register' :
        $file = 'register.php';
        break;
    case 'disconnect' :
        $file = 'disconnect.php';
        break;
    case 'admin' :
        $file = 'admin.php';
        break;
    case 'membre' :
        $file = 'membre.php';
        break;
}


if (isset($_GET['submit']) AND isset($_GET['data'])) {
    $search = $_GET['data'];
    header('Location: index.php?page=search&data='.$search);
    exit();
}


//déclenchage de la mise en tampon
ob_start();
include __DIR__ . '/inc/' . $file;
$buffer = ob_get_clean();
include THEME . 'layout.html.php';
?>

