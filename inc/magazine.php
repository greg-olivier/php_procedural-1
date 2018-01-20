<?php

$action = (isset($_GET['action'])) ? $_GET['action'] : 'index';

switch ($action) {
    default:
    case 'index':
        indexAction();
        break;
    case 'detail':
        detailAction();
        break;
}


function indexAction(){
    global $bdd;
    $sql = 'SELECT id, titre, contenu, thumbnail, date FROM article WHERE publier = 1 ORDER BY date DESC LIMIT 3';

    $result = $bdd-> query($sql);

    $last_articles = $result->fetchAll();

    include VUE . 'magazine.html.php';
}

function detailAction(){
    global $bdd;

    $id = $_GET['id'];

    $sql = 'SELECT art.id, art.titre,art.date, art.image, art.contenu, login_auteur FROM article art JOIN auteur a ON art.id_auteur = a.id_auteur WHERE art.id = ?';
    $result = $bdd->prepare($sql);

    $result->execute([$id]);
    
    $current_article = $result->fetch();

    include VUE . 'article.html.php';
}



