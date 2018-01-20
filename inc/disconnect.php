<?php
if (!isset($_SESSION['auth']) AND (!$_SESSION['auth']) === true) {
    header('Location: ?page=connect');
    exit();
};


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['confirm'] === 'OK') {
        session_destroy();
        setcookie(session_name(), session_id(), time() - 10, '/', null, null, true);
        header('Location: ?page=connect');
        exit();
    } else {
        header('Location: ?page=admin');
        exit();
    }
}

include VUE.'disconnect.html.php';