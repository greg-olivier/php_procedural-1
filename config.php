<?php
// DIRECTORY SHORTCUT
define('THEME', 'theme/');
define('THEME_ADMIN', 'theme_admin/');
define('VUE', 'theme/vue/');
define('INC','inc/');
define('APP','inc/app/');
define('NAV','inc/nav/');
define('CSS', 'theme/css/');
define('IMAGE', 'images/');
define('THUMB', 'images/thumbnails/');

$images_dir ="images/";

$locale = '';


$mail_admin = 'test@test.fr';



// Config des temps de stockage des différents éléments
$time_store_token = 5 * 60; // 5min -> temps de saisie des formulaires
$time_store_cache = 24 * 3600; // 24h -> temps avant check si cache a été modifié
$time_store_cookie = 12 * 3600; // 12h -> temps avant que le cookies ne soit plus valable


// Versionning de fichier CSS
// (pour être sur que si le fichier css a été modifié, il soit rechargé)
$sha1FileCss = sha1_file(CSS.'style.css');
$sha1FileCssAdmin = sha1_file(THEME_ADMIN .'css/style.css');


// CONNEXION DATABASE
$host = 'localhost';
$dbname='bdd1';
$user = 'root';
$pwd = '';
$dsn = 'mysql:host='.$host.';dbname='.$dbname.';charset=utf8';



