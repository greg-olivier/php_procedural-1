<?php


$action = (isset($_GET['action'])) ? $_GET['action'] : 'index';
$file = "cache/".md5(($_SERVER['QUERY_STRING'])).'.cache';

if (!is_dir('cache')) {
    mkdir('cache');
}
if (is_file($file) && (time() - filemtime($file)) < 3600) { // si le fichier existe et qu'il a été modifié il y a moins de 3600sec
    readfile($file);
} else {
    ob_start();
    switch ($action) {
        default:
        case 'index':
            indexAction();
            break;
        case 'allproducts':
            listAction();
            break;
        case 'categorie':
            categorieAction();
            break;
        case 'detail':
            detailAction();
            break;
        case 'list-tag':
            tagAction();
            break;
    }

    $buffer = ob_get_flush();
    file_put_contents($file,$buffer);
}


function indexAction()
{
    global $bdd;
    $sql = 'SELECT cat.id_cat, cat.titre, COUNT(id) nb FROM categorie cat JOIN produit p ON cat.id_cat = p.id_cat GROUP BY cat.id_cat ORDER BY p.date DESC';

    $result = $bdd->query($sql);

    $all_categories = $result->fetchAll();


    include VUE . 'categories.html.php';
}

function listAction()
{
    global $bdd;
    $sql = 'SELECT id, titre, thumbnail, contenu, prix, date FROM produit WHERE publier = 1';
    $result = $bdd->query($sql);
    $all_products = $result->fetchAll();

    $sql = 'SELECT COUNT(id) nb FROM produit WHERE publier = 1';
    $result = $bdd->query($sql);
    $nb_items = $result->fetch();
    $nb_items = $nb_items['nb'];

    include VUE . 'list.html.php';
}

function categorieAction()
{
    global $bdd;

    $cat = $_GET['cat'];

    $sql = 'SELECT p.id_cat, p.id, p.titre, prix, p.thumbnail, p.contenu, p.date, cat.titre nom FROM produit p JOIN categorie cat ON p.id_cat=cat.id_cat WHERE cat.id_cat = ? ORDER BY p.prix DESC';
    $result = $bdd->prepare($sql);
    $result->execute([$cat]);
    $category_products = $result->fetchAll();

    $sql = 'SELECT COUNT(p.id) nb FROM produit p JOIN categorie cat ON p.id_cat=cat.id_cat WHERE cat.id_cat = ? AND publier = 1';
    $result = $bdd->prepare($sql);
    $result->execute([$cat]);
    $nb_items = $result->fetch();
    $nb_items = $nb_items['nb'];

    include VUE . 'category.html.php';
}

function detailAction()
{
    global $bdd;

    $id = $_GET['id'];


    ////// Recuperation du détail d'un produit ////////////////
    $sql = 'SELECT p.id, p.titre, image, contenu, prix, p.date, cat.titre nom, p.id_cat, tp.nom tagname, tp.id_tag  FROM produit p JOIN categorie cat ON p.id_cat=cat.id_cat JOIN tags_pdts tps ON p.id = tps.id JOIN tag_pdt tp ON tps.id_tag = tp.id_tag
            WHERE p.id = ? AND publier = 1';
    $result = $bdd->prepare($sql);
    $result->execute([$id]);
    $current_products = $result->fetchAll();

    /*
    ////// Recuperation des tags //////////
    $sql = 'SELECT  tp.nom tagname, tp.id_tag FROM produit p 
            JOIN tags_pdts tps ON p.id = tps.id JOIN tag_pdt tp ON tps.id_tag = tp.id_tag WHERE p.id = ? AND publier = 1';
    $result = $bdd->prepare($sql);
    $result->execute([$id]);
    $list_tags = $result->fetchAll();
    */

    include VUE . 'produit.html.php';
}

function tagAction()
{
    global $bdd;

    $tag = $_GET['tag'];
    $sql = 'SELECT tp.nom, pr.id,pr.titre, pr.prix, pr.date, pr.thumbnail, pr.contenu FROM produit pr JOIN tags_pdts tps ON pr.id = tps.id JOIN tag_pdt tp ON tps.id_tag = tp.id_tag WHERE tp.id_tag=?  AND pr.publier = 1 ORDER BY pr.date DESC';
    $result = $bdd->prepare($sql);
    $result->execute([$tag]);
    $tag_pdts = $result->fetchAll();

    include VUE . 'tag_pdts.html.php';
}



