<?php

$get_data = htmlspecialchars($_GET['data']);

if ($_GET['data'] != '') {
    if (strlen($_GET['data']) < 3) {
        $erreur = "<div class=\"alert alert-info\">
        <h4><strong> Info : </strong>Vous devez saisir au minimum 3 lettres</h4></div>";
    } else {
        $results_search = resultSearch($_GET['data']);
        if ($results_search[1]['nb'] != 0){
            $results_search = resultSearch($_GET['data']);
    }else {

            $erreur = "<div class=\"alert alert-danger\">
        <h4>Aucun résultat ne correspond à votre recherche \"".$get_data."\"</h4></div>";
        }
    }

} else {
    $erreur = "<div class=\"alert alert-warning\">
        <h4><strong> Attention ! </strong>Veuillez saisir dans le formulaire de recherche</h4></div>";
}

include VUE . 'search.html.php';


function resultSearch($data) {
    global $bdd;

    $sql = 'SELECT titre tart, image, contenu, date,id FROM article p WHERE titre LIKE ? AND publier = 1 ';
    $result = $bdd->prepare($sql);
    $search_extr = "%".$data."%";
    $result->execute([$search_extr]);

    $search_results_art = $result->fetchAll();

    $sql = 'SELECT titre tpr, image,id, thumbnail, date, contenu FROM produit p WHERE titre LIKE ? AND publier = 1  ';
    $result = $bdd->prepare($sql);
    $search_extr = "%".$data."%";
    $result->execute([$search_extr]);

    $search_results_pdt = $result->fetchAll();


    $sql = 'SELECT COUNT(id) nb FROM article p WHERE titre LIKE ? AND publier = 1 ';
    $result = $bdd->prepare($sql);
    $search_extr = "%".$data."%";
    $result->execute([$search_extr]);
    $search_results_art_items = $result->fetch();

    $sql = 'SELECT COUNT(id) nb FROM produit p WHERE titre LIKE ? AND publier = 1 ';
    $result = $bdd->prepare($sql);
    $search_extr = "%".$data."%";
    $result->execute([$search_extr]);
    $search_results_pdt_items = $result->fetch();

    $search_results['nb'] = $search_results_art_items['nb'] + $search_results_pdt_items['nb'];
    $search_results['nb_art']= $search_results_art_items['nb'];
    $search_results['nb_pdt']= $search_results_pdt_items['nb'];
    $search_results['search'] = $data;

    $search_results_data = [];
    $search_results_all = array_merge($search_results_pdt , $search_results_art);
    array_push($search_results_data, $search_results_all);
    array_push($search_results_data, $search_results);
return $search_results_data;

}




