<?php

// Vérification si connexion déjà faite
if (isset($_SESSION['auth']) AND ($_SESSION['auth']) === true AND ($_SESSION['titre']) ==='admin') {
    header('Location: ?page=admin');
    exit();
} else if (isset($_SESSION['auth']) AND ($_SESSION['auth']) === true AND !isset($_SESSION['titre'])) {
    header('Location: ?page=membre');
    exit();
}

// Vérification si pas d'erreur dans le formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['token'])) {
        var_dump($_SESSION);
        header('Location: ?page=register');
        exit();
    } else {
        if ($_POST['token'] == $_SESSION['token'] && time() - $_SESSION['token_time'] <= $time_store_token) {
            $erreur = "";
            $login = $_POST["login"];
            $pass_hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            if (strlen($_POST["login"]) < 3) {
                $erreur .= "Login non-rempli ou trop court<br>";
            }
            if (strlen($_POST["pass"]) < 3) {
                $erreur .= "Votre mot de passe doit avoir au moins 3 caractères<br>";
            }

// vérification si email ou login existe déjà dans la BDD
            $sql = $bdd->prepare('SELECT id_auteur FROM auteur WHERE login_auteur = ?');
            $sql->execute([$login]);
            $result_login = $sql->fetch();

            if ($result_login == TRUE) {
                $erreur .= 'Login déjà utilisé<br>';
            }


            // Insertion de l'utilisateur dans la bdd si pas d'erreur
            if ($erreur === "") {
                $query = $bdd->prepare('INSERT INTO auteur(login_auteur, pwd_auteur)
        VALUES(:login, :pass)');
                $query->bindValue(":login", $login, PDO::PARAM_STR);
                $query->bindValue(":pass", $pass_hash, PDO::PARAM_STR);
                $query->execute();

// Vérification si identifiants de connexion sont ok
                $query = $bdd->prepare('SELECT login_auteur, pwd_auteur FROM auteur WHERE login_auteur = ?');
                $query->execute([$login]);
                $user_connect = $query->fetch();

                $pass = password_verify($_POST['pass'], $user_connect['pwd_auteur']);

                if (!$user_connect OR $pass === FALSE) {
                    $fail = 'Erreur lors de l\'inscription. Contactez le webmaster';
                } else {
                    // Si pas d'erreur, remplissage des données de session et redirection vers page 'connexion'
                    $_SESSION['IPaddress'] = sha1($_SERVER['REMOTE_ADDR']);
                    $_SESSION['userAgent'] = sha1($_SERVER['HTTP_USER_AGENT']);
                    $_SESSION['auth'] = true;
                    $_SESSION['login'] = $user_connect['login_auteur'];
                    header('Location: ?page=connect');
                    exit();
                }
            }
        }
    }
}


// Appel de la fonction de génération de token pour validation du formulaire (Protection CSRF)
$token = token_form();

include VUE . 'register.html.php';


