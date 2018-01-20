<?php


// Vérification si connexion ok
if (!isset($_SESSION['auth']) AND $_SESSION['auth'] !== true AND ($_SESSION['titre']) !== 'admin') {
    header('Location: ?page=connect');
    exit();
} else {

    $action = (isset($_GET['action'])) ? $_GET['action'] : 'index';
    if ($_SESSION['IPaddress'] === sha1($_SERVER['REMOTE_ADDR']) || ($_SESSION['userAgent'] === sha1($_SERVER['HTTP_USER_AGENT']))) {

            switch ($action) {
                default:
                case 'all':
                    listAction();
                    break;
                case 'add':
                    addAction();
                    break;
                case 'detail':
                    detailAction();
                    break;
                case 'delete':
                    deleteAction();
                    break;
                case 'edit':
                    editAction();
                    break;
            }
    }
}

function listAction()
{
    global $bdd;
    $id_auteur = $_SESSION['id'];

    // Articles publiés
    $sql = 'SELECT id, titre, contenu, publier FROM article WHERE id_auteur = ? AND publier = 1 ORDER BY date DESC';
    $result = $bdd->prepare($sql);
    $result->execute([$id_auteur]);
    $all_articles_pub = $result->fetchAll();

    $sql = 'SELECT COUNT(id) nb FROM article WHERE id_auteur = ? AND publier = 1';
    $result = $bdd->prepare($sql);
    $result->execute([$id_auteur]);
    $nb_items = $result->fetch();
    $nb_items_pub = $nb_items['nb'];


// Articles non publiés
    $sql = 'SELECT id, titre, contenu, publier FROM article WHERE id_auteur = ? AND publier = 0 ORDER BY date DESC';
    $result = $bdd->prepare($sql);
    $result->execute([$id_auteur]);
    $all_articles_nopub = $result->fetchAll();

    $sql = 'SELECT COUNT(id) nb FROM article WHERE id_auteur = ? AND publier = 0';
    $result = $bdd->prepare($sql);
    $result->execute([$id_auteur]);
    $nb_items = $result->fetch();
    $nb_items_nopub = $nb_items['nb'];

    include THEME_ADMIN . 'vue/list.html.php';
}

function addAction()
{
    global $bdd;

    $erreur = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!isset($_SESSION['token'])) {
            header('Location: ?page=admin&action=add');
            exit();
        } else {
            global $time_store_token;
            if (($_POST['token'] == $_SESSION['token']) && (time() - $_SESSION['token_time']) <= $time_store_token) {
                if ($_POST["titre"] === '') {
                    $erreur .= 'Merci de renseigner le titre<br>';
                }
                if ($_POST["contenu"] === '') {
                    $erreur .= 'Merci de renseigner le contenu<br>';
                }

                if ($_FILES['fichier_image']!== []) {
                    $image = $_FILES['fichier_image']['name'];
                    $image_id = $_FILES['fichier_image'];
                    $ext = pathinfo($image_id['name'], PATHINFO_EXTENSION);
                    $fileName = sha1(uniqid(rand(), true)).'.'.$ext;
                } else {
                    $image = NULL;
                }
                if (isset($_POST['publier'])) {
                    $publier = 1;
                } else {
                    $publier = 0;
                }


                if(!is_dir(IMAGE)) {
                    mkdir(IMAGE);
                    }

                $images_dir = scandir(IMAGE);

                if ($image !== NULL)  {
                    if (($images_dir === FALSE) OR (array_search($fileName, $images_dir) === FALSE)) {
                        $upload_ok = upload($image_id,IMAGE.$fileName,1000000, array('image/png','image/jpg','image/jpeg'));
                        if ($upload_ok === FALSE) {
                            $erreur .= 'Problème lors du téléchargement du fichier. merci de recommencer';
                        }
                        else {
                            if(!is_dir(THUMB)) {
                                mkdir(THUMB);
                            }
                            $thumbnail = thumbnail(IMAGE.$fileName, THUMB);
                        }
                    }
                }

                if ($erreur === '') {
                    $id_auteur = $_SESSION['id'];
                    $titre = $_POST['titre'];
                    $contenu = $_POST['contenu'];
                    $date = date('Y-m-d H:i:s');

                    $sql = 'INSERT INTO article (titre, contenu, date, id_auteur, image, thumbnail, publier)
                            VALUES (?, ?, ?, ?, ?, ?, ?)';
                    $result = $bdd->prepare($sql);
                    $result->execute([$titre, $contenu, $date, $id_auteur, $image, $thumbnail, $publier]);
                    header('Location: ?page=admin&action=all');
                    exit();
                }

            }
        }
    }
    $token = token_form();
    include THEME_ADMIN . 'vue/add-article.html.php';
}


function detailAction()
{
    global $bdd;

    $id = $_GET['id'];


    $sql = 'SELECT id, titre, contenu, image, date FROM article WHERE id = ?';
    $result = $bdd->prepare($sql);
    $result->execute([$id]);
    $current_article = $result->fetch();


    include THEME_ADMIN . 'vue/detail-article.html.php';
}

function deleteAction()
{
    global $bdd;

    $id = $_GET['id'];


    $sql = 'SELECT image, thumbnail FROM article WHERE id = ?';
    $result = $bdd->prepare($sql);
    $result->execute([$id]);
    $file_img = $result->fetch();

    unlink(IMAGE.$file_img['image']);
    unlink(THUMB.$file_img['thumbnail']);

    $sql = 'DELETE FROM article WHERE id = ?';
    $result = $bdd->prepare($sql);
    $result->execute([$id]);

    header('Location: ?page=admin&action=list');
    exit();
}

function editAction()
{
    global $bdd;

    $id = $_GET['id'];
    $sql = 'SELECT id, titre, contenu, image, thumbnail, date, publier FROM article WHERE id = ?';
    $result = $bdd->prepare($sql);
    $result->execute([$id]);
    $article_edit = $result->fetch();

    $erreur = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!isset($_SESSION['token'])) {
            header('Location: ?page=admin&action=edit&id=' . $id);
            exit();
        } else {
            global $time_store_token;
            if (($_POST['token'] == $_SESSION['token']) && (time() - $_SESSION['token_time']) <= $time_store_token) {
                if ($_POST["titre"] === '') {
                    $erreur .= 'Merci de renseigner le titre<br>';
                }
                if ($_POST["contenu"] === '') {
                    $erreur .= 'Merci de renseigner le contenu<br>';
                }
                if ($_POST["date"] === '') {
                     $date = date('Y-m-d H:i:s');
                } else {
                    $date = $_POST['date'];
                }

                $titre = $_POST['titre'];
                $contenu = $_POST['contenu'];



                if ($_FILES['fichier_image']['name'] !== '') {
                    $image = $_FILES['fichier_image']['name'];
                    $image_id = $_FILES['fichier_image'];
                    $ext = pathinfo($image_id['name'], PATHINFO_EXTENSION);
                    $fileName = sha1(uniqid(rand(), true)).'.'.$ext;
                } else {
                    $image = $article_edit['image'];
                    $thumbnail = $article_edit['thumbnail'];
                }

                if (isset($_POST['publier'])) {
                    $publier = 1;
                } else {
                    $publier = 0;
                }
                if(!is_dir(IMAGE)) {
                    mkdir(IMAGE);
                }


                if ($image !== $article_edit['image'])  {
                        $upload_ok = upload($image_id,IMAGE.$fileName,1000000, array('image/png','image/jpg','image/jpeg'));
                        if ($upload_ok === FALSE) {
                            $erreur .= 'Problème lors du téléchargement du fichier. merci de recommencer';
                        } else {
                            if(!is_dir(THUMB)) {
                                mkdir(THUMB);
                            }
                            $thumbnail = thumbnail(IMAGE.$fileName, THUMB);
                        }

                    }




                if ($erreur === '') {
                    $sql = 'UPDATE article SET titre = ?, contenu = ?, image = ?, thumbnail = ?, date = ? ,publier = ? WHERE id = ?';
                    $result = $bdd->prepare($sql);
                    $result->execute([$titre, $contenu, $fileName, $thumbnail, $date, $publier, $id]);

                    header('Location: ?page=admin&action=all');
                    exit();
                }
            }
        }
    }
    $token = token_form();
    include THEME_ADMIN . 'vue/edit.html.php';
}

