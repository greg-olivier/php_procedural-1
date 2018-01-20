<?php

function extr($str, $max = 150, $add = '[...]')
{
    $text = strip_tags($str);
    //var_dump($text);
    if (strlen($text) > $max) {
        $text = substr($text, 0, $max) . $add;
    }
    return $text;
}

function fr_date_time($time, $format = '%A %d %B %Y à %Hh%M')
{
    $newtime = strftime($format, strtotime($time));
    return $newtime;
}


function fr_date($time, $format = '%d/%m/%g')
{
    $newtime = strftime($format, strtotime($time));
    return $newtime;
}

function add_euro($price)
{
    $str_euro = $price .= '€';
    return $str_euro;
}


// Protection CSRF : token
function token_form()
{
    $token = sha1(uniqid(rand(), TRUE));
    $_SESSION['token'] = $token;
    $_SESSION['token_time'] = time();
    return $token;
}

function upload($id, $destination, $maxsize = FALSE, $typesMime = FALSE)
{

    //Test1: fichier correctement uploadé
    if (($id === '') OR $id['error'] > 0)
        return FALSE;

    //Test2: taille limite
    if ($maxsize !== FALSE AND $id['size'] > $maxsize)
        return FALSE;

    //Test3: extension
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $type = $finfo->file($id['tmp_name']);

    if ($typesMime !== FALSE AND !in_array($type, $typesMime))
        return FALSE;

    //Déplacement
    return move_uploaded_file($id['tmp_name'], $destination);
}


function thumbnail($source, $destination, $width = 240, $height = 180)
{

    $ext = strtolower(pathinfo($source, PATHINFO_EXTENSION));
    $file = pathinfo($source, PATHINFO_FILENAME);
    switch ($ext) {
        case 'jpg':
        case 'jpeg' :
            $src_image = imagecreatefromjpeg($source);
            break;
        case 'png' :
            $src_image = imagecreatefrompng($source);
            break;
        case 'gif' :
            $src_image = imagecreatefromgif($source);
            break;
    }
    $dst_image = imagecreatetruecolor($width, $height);
    $r = 255;
    $v = 0;
    $b = 0;
    $couleur_fond = imagecolorallocate($dst_image, $b, $v, $r);
    imagecolortransparent($dst_image, $couleur_fond);
    imagefill($dst_image, 0, 0, $couleur_fond);


    list ($src_w, $src_h) = getimagesize($source);

    $ratio_orig = $src_w / $src_h;
    $dst_w = $width;
    $dst_h = $height;
    if ($dst_w / $dst_h > $ratio_orig) {

        $dst_w = $dst_h * $ratio_orig;
    } else {

        $dst_h = $dst_w / $ratio_orig;
    }
    $dst_x = ($width - $dst_w) / 2;
    $dst_y = ($height - $dst_h) / 2;

    imagecopyresampled($dst_image, $src_image, $dst_x, $dst_y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
    if (imagepng($dst_image, $destination . '/' . $file . '_256x180' . '.png')) {
        imagedestroy($dst_image);
        imagedestroy($src_image);
        return $file . '_240x180' . '.png';
    } else {

        return null;
    }
}
