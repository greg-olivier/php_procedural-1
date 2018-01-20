<?php

// Vérification si connexion ok
if (!isset($_SESSION['auth']) AND $_SESSION['auth'] !== true) {
    header ('Location: ?page=connect');
    exit();
} else if (!isset($_SESSION['titre'])) {

    if ($_SESSION['IPaddress'] === sha1($_SERVER['REMOTE_ADDR']) || ($_SESSION['userAgent']=== sha1($_SERVER['HTTP_USER_AGENT']))) {

        global $bdd;


        $sql = 'SELECT art.id, art.titre, contenu, thumbnail, date, login_auteur FROM article art JOIN auteur a ON art.id_auteur = a.id_auteur ORDER BY date DESC LIMIT 3';
        $result = $bdd-> query($sql);
        $last_articles = $result->fetchAll();

        $tag = 'Nouveautés';
        $sql = 'SELECT pr.id,pr.titre, pr.prix, pr.date, pr.thumbnail, pr.contenu FROM produit pr JOIN tags_pdts tps ON pr.id = tps.id JOIN tag_pdt tp ON tps.id_tag = tp.id_tag WHERE tp.nom=?  AND pr.publier = 1 ORDER BY pr.date DESC LIMIT 3';
        $result = $bdd->prepare($sql);
        $result->execute([$tag]);
        $new_pdts = $result->fetchAll();


        $token = token_form();
        include VUE. 'membre.html.php';
    } else {
        echo 'Hacker!!';
    }
}