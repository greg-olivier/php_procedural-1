<?php



$messagesParPage=3;


$sql = 'SELECT COUNT(*) AS total FROM article';
$result = $bdd-> query($sql);
$retour_total = $result->fetch();

$totalpages=$retour_total['total'];

$nombreDePages=ceil($totalpages/$messagesParPage);

if(isset($_GET['p'])) {
     $pageActuelle=intval($_GET['p']);
     if($pageActuelle>$nombreDePages) {
          $pageActuelle=$nombreDePages;
     }
} else {
     $pageActuelle=1;
}

$premiereEntree=($pageActuelle-1)*$messagesParPage;


$sql = 'SELECT art.id, art.titre, contenu, thumbnail, date, login_auteur FROM article art JOIN auteur a ON art.id_auteur = a.id_auteur ORDER BY date DESC  LIMIT '.$premiereEntree.','.$messagesParPage;
$result = $bdd-> query($sql);
$last_articles = $result->fetchAll();


include VUE . 'accueil.html.php';
