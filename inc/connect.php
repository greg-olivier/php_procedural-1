<?php

// Vérification si connexion déjà faite
if (isset($_SESSION['auth']) AND ($_SESSION['auth']) === true AND $_SESSION['titre'] === 'admin') {
    header('Location: ?page=admin');
    exit();
}

else if (isset($_SESSION['auth']) AND ($_SESSION['auth']) === true AND !isset($_SESSION['titre'])) {
    header('Location: ?page=membre');
    exit();
}
$erreur = '';
// Vérification si pas d'erreur dans le formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['token'])) {
        header('Location: ?page=connect');
        exit();
    } else {
        if ($_POST['token'] == $_SESSION['token'] && time() - $_SESSION['token_time'] <= $time_store_token) {
            $login = $_POST['login'];
            if (strlen($login) < 3) {
                $erreur .= "Veuillez entrer votre login<br>";
            }
            if (!isset($_POST["pass"])) {
                $erreur .= "Veuillez entrer votre mot de passe<br>";
            }


// Récupération des infos BDD des identifiants
            $sql = 'SELECT id_auteur, login_auteur, pwd_auteur, titre FROM auteur WHERE login_auteur = ?';
            $req = $bdd->prepare($sql);
            $req->execute([$login]);
            $resultat = $req->fetch();

            // Vérification des identifiants
            $pass = password_verify($_POST['pass'], $resultat['pwd_auteur']);
            if (!$resultat OR $pass == FALSE) {
                $erreur .= 'Login/Mot de passe non reconnu';
                sleep(1);
            } else {
                $_SESSION['IPaddress'] = sha1($_SERVER['REMOTE_ADDR']);
                $_SESSION['userAgent'] = sha1($_SERVER['HTTP_USER_AGENT']);
                $_SESSION['auth'] = true;
                $_SESSION['login'] = $resultat['login_auteur'];
                if ($resultat['titre'] === 'admin') {
                    $_SESSION['titre'] = $resultat['titre'];
                    $_SESSION['id'] = $resultat['id_auteur'];
                    header('Location: ?page=admin');
                    exit();
                } else {
                    header('Location: ?page=membre');
                    exit();
                }

            }

        }
    }
}

// Appel de la fonction de génération de token pour validation du formulaire (Protection CSRF)
$token = token_form();

include VUE . 'connect.html.php';

