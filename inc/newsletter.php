<?php
$fileCsv = 'newsletter.csv';
$erreur = "";

if (isset($_POST['mail_newsletter'])) {
    if (!($email = filter_var($_POST['mail_newsletter'], FILTER_VALIDATE_EMAIL)))
        $message = 'Format d\'email incorrect';
    else {

        ///////CSV
        if (file_exists($fileCsv)) {
            $fp = fopen($fileCsv, 'r');
            while (($emails = fgetcsv($fp)) !== false) {
                if (in_array($email, $emails)) {
                    $erreur .= 'Déjà inscrit';
                    fclose($fp);
                    break;
                }
            }
        }

        if (!isset($message)) {
            $fp = fopen($fileCsv, 'a');
            fputcsv($fp, [$email]);
            fclose($fp);
        }
        ////////////
    }
} else {
    $erreur .= 'Utiliser le formulaire pour vous inscrire :)';
}

include THEME . 'vue/newsletter.html.php';
