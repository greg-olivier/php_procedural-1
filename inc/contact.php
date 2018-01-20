<?php
if (isset($_POST["submit"])) {
    $erreur = "";
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $objet = $_POST["objet"];
    $message = $_POST["message"];
    if (!isset($_POST["civil"])) {
        $erreur .= "Sélectionnez votre civilité<br>";
    }
    if (strlen($nom) < 3) {
        if ($nom == '') {
            $erreur .= "Nom obligatoire<br>";
        } else {
            $erreur .= "Nom saisi trop court<br>";
        }
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
        if ($email == '') {
            $erreur .= "Email obligatoire<br>";
        } else {
            $erreur .= "Email invalide<br>";
        }
    }
    if ($objet == '') {
        $erreur .= "Objet obligatoire<br>";
    }
    if ($message == '') {
        $erreur .= "Message obligatoire<br>";
    }

    $interest = [];
    if (isset($_POST["interest-sport"])) {
        array_push($interest, $_POST["interest-sport"]);
    }
    if (isset($_POST["interest-music"])) {
        array_push($interest, $_POST["interest-music"]);
    }
    if (isset($_POST["interest-info"])) {
        array_push($interest, $_POST["interest-info"]);
    }
    if ($interest === []) {
        $erreur .= "Centres d'intérêt non-renseignés<br>";
    }

    if ($erreur === "") {

        $civil = $_POST["civil"];
        $interest = serialize($interest);

        $sql = $bdd->prepare('SELECT id_contact FROM contact WHERE email = ?');
        $sql->execute([$email]);
        $result = $sql->fetch();

        if ($result == TRUE) {
            $erreur .= 'Email déjà connu <br>';
        } else {
            $sql = $bdd->prepare('INSERT INTO contact( genre, nom, email, objet, message, date, interets)
        VALUES(?, ?, ? , ?, ?, NOW(), ?)');
            $sql->execute([$civil, $nom, $email, $objet, $message, $interest]);


            // Variables de mail()
            $to =' Test <test@test.fr>';

            $sujet = 'Nouveau message de votre site';

            ob_start();
            include VUE.'mail.html.php';
            $contenu = ob_get_clean();

            // En-têtes
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

            $sent_mail = @mail($to, $sujet, $contenu, $headers); // @ cache les messages d'erreur

            if ($sent_mail === TRUE) {
                $erreur .= 'Votre message a bien été transmis<br>';
            } else {
                $erreur = 'Un problème est survenu ! Merci de réessayer<br>';
            }

        }

    }


}


include VUE . 'contact.html.php';
