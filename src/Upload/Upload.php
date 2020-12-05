<?php

namespace Core\Upload;

use \App\App;
use Core\Config;

/**
 * Class Upload
 *
 * @package Core\Upload
 */
class Upload
{

    /**
     * @var
     */
    protected $upload_dir;
    /**
     * @var
     */
    protected $upload_max_size;
    /**
     * @var null
     */
    protected $extList = null;
    /**
     * @var int
     */
    protected $thumbnail_size = 250;


    /**
     * Redimensionne l'image de facon proportionnelle
     *
     * @param $W_max   : Largeur maximale ou 0
     * @param $H_max   : Hauteur maximale ou 0
     * @param $rep_Dst : Repertoire de destination
     * @param $img_Dst : Nom de l'Image finale
     * @param $rep_Src : Repertoire source
     * @param $img_Src : Nom del l'image source
     * @return bool : Retourne 1 si c'est bon et 0 si ce n'est pas bon
     *                 Extension accceptées (.jpg, .jpeg, .png)
     */
    public function resizeRatio ($W_max, $H_max, $rep_Dst, $img_Dst, $rep_Src, $img_Src)
    {

        $condition = 0;

        if ($rep_Dst == '') {
            $rep_Dst = $rep_Src;
        } // (meme repertoire)

        if ($img_Dst == '') {
            $img_Dst = $img_Src;
        }

        if (file_exists($rep_Src . $img_Src) && ($W_max != 0 || $H_max != 0)) {

            // extensions acceptees :
            $extension_Allowed = 'jpg,jpeg,png'; // (l espace avant jpg est important)

            // extension fichier Source
            $extension_Src = strtolower(pathinfo($img_Src, PATHINFO_EXTENSION));

            // extension OK ? on continue ...
            if (in_array($extension_Src, explode(',', $extension_Allowed))) {

                // recuperation des dimensions de l image Src
                $img_size = getimagesize($rep_Src . $img_Src);
                $W_Src = $img_size[0]; // largeur
                $H_Src = $img_size[1]; // hauteur

                // condition de redimensionnement et dimensions de l image finale

                // A- LARGEUR ET HAUTEUR maxi fixes
                if ($W_max != 0 && $H_max != 0) {
                    $ratiox = $W_Src / $W_max; // ratio en largeur
                    $ratioy = $H_Src / $H_max; // ratio en hauteur
                    $ratio = max($ratiox, $ratioy); // le plus grand
                    $W = $W_Src / $ratio;
                    $H = $H_Src / $ratio;
                    $condition = ($W_Src > $W) || ($W_Src > $H); // 1 si vrai (true)
                } // B- HAUTEUR maxi fixe
                elseif ($W_max == 0 && $H_max != 0) {
                    $H = $H_max;
                    $W = $H * ($W_Src / $H_Src);
                    $condition = $H_Src > $H_max; // 1 si vrai (true)
                } // C- LARGEUR maxi fixe
                elseif ($W_max != 0 && $H_max == 0) {
                    $W = $W_max;
                    $H = $W * ($H_Src / $W_Src);
                    $condition = $W_Src > $W_max; // 1 si vrai (true)
                } else {
                    $W = $W_max;
                    $H = $H_max;
                    $condition = 1; // 1 si vrai (true)
                }
                // -------------------------------------------------------------
                // on REDIMENSIONNE si la condition est vraie
                // -------------------------------------------------------------
                // Par defaut :
                // Si l'image Source est plus petite que les dimensions indiquees :
                // PAS de redimensionnement.
                // Mais on peut "forcer" le redimensionnement en ajoutant ici :
                // $condition = 1;
                if ($condition == 1) {
                    // ----------------------------------------------------------
                    // creation de la ressource-image "Src" en fonction de l extension
                    switch ($extension_Src) {
                        case 'jpg':
                        case 'jpeg':
                            $Ress_Src = imagecreatefromjpeg($rep_Src . $img_Src);
                            break;
                        case 'png':
                            $Ress_Src = imagecreatefrompng($rep_Src . $img_Src);
                            break;
                    }
                    // ----------------------------------------------------------
                    // creation d une ressource-image "Dst" aux dimensions finales
                    // fond noir (par defaut)
                    switch ($extension_Src) {
                        case 'jpg':
                        case 'jpeg':
                            $Ress_Dst = imagecreatetruecolor($W, $H);
                            break;
                        case 'png':
                            $Ress_Dst = imagecreatetruecolor($W, $H);
                            // fond transparent (pour les png avec transparence)
                            imagesavealpha($Ress_Dst, true);
                            $trans_color = imagecolorallocatealpha($Ress_Dst, 0, 0, 0, 127);
                            imagefill($Ress_Dst, 0, 0, $trans_color);
                            break;
                    }
                    // ----------------------------------------------------------
                    // REDIMENSIONNEMENT (copie, redimensionne, re-echantillonne)
                    imagecopyresampled($Ress_Dst, $Ress_Src, 0, 0, 0, 0, $W, $H, $W_Src, $H_Src);
                    // ----------------------------------------------------------
                    // ENREGISTREMENT dans le repertoire (avec la fonction appropriee)
                    switch ($extension_Src) {
                        case 'jpg':
                        case 'jpeg':
                            imagejpeg($Ress_Dst, $rep_Dst . $img_Dst);
                            break;
                        case 'png':
                            imagepng($Ress_Dst, $rep_Dst . $img_Dst);
                            break;
                    }
                    // ----------------------------------------------------------
                    // liberation des ressources-image
                    imagedestroy($Ress_Src);
                    imagedestroy($Ress_Dst);
                }
                // -------------------------------------------------------------
            }
        }
// 	---------------------------------------------------------------
        // si le fichier a bien ete cree
        if ($condition == 1 && file_exists($rep_Dst . $img_Dst)) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Redimensionne l'image depuis le centre
     *
     * @param $W_fin   : Largeur finale
     * @param $H_fin   : Hauteur finale
     * @param $rep_Dst : Repertoire destinataire
     * @param $img_Dst : Image finale
     * @param $rep_Src : Repertoire Source
     * @param $img_Src : Image source
     */
    public function resizeCenter ($W_fin, $H_fin, $rep_Dst, $img_Dst, $rep_Src, $img_Src)
    {
        // ---------------------
        $condition = 0;
        // Si certains paramètres ont pour valeur '' :
        if ($rep_Dst == '') {
            $rep_Dst = $rep_Src;
        } // (même répertoire)
        if ($img_Dst == '') {
            $img_Dst = $img_Src;
        } // (même nom)

        if (file_exists($rep_Src . $img_Src)) {
            // ----------------------
            // extensions acceptées :
            $extension_Allowed = 'jpg,jpeg,png';    // (sans espaces)
            // extension fichier Source
            $extension_Src = strtolower(pathinfo($img_Src, PATHINFO_EXTENSION));
            // ----------------------
            // extension OK ? on continue ...
            if (in_array($extension_Src, explode(',', $extension_Allowed))) {
                // ------------------------
                // récupération des dimensions de l'image Source
                $img_size = getimagesize($rep_Src . $img_Src);
                $W_Src = $img_size[0]; // largeur
                $H_Src = $img_size[1]; // hauteur
                // ------------------------------------------------
                // condition de crop et dimensions de l'image finale
                // ------------------------------------------------
                // A- crop aux dimensions indiquées
                if ($W_fin != 0 && $H_fin != 0) {
                    $W = $W_fin;
                    $H = $H_fin;
                }
                // ------------------------
                // B- crop en HAUTEUR (meme largeur que la source)
                elseif ($W_fin == 0 && $H_fin != 0) {
                    $H = $H_fin;
                    $W = $W_Src;
                }
                // ------------------------
                // C- crop en LARGEUR (meme hauteur que la source)
                elseif ($W_fin != 0 && $H_fin == 0) {
                    $W = $W_fin;
                    $H = $H_Src;
                } // D- crop "carre" a la plus petite dimension de l'image source
                elseif ($W_fin == 0 && $H_fin == 0) {
                    if ($W_Src >= $H_Src) {
                        $W = $H_Src;
                        $H = $H_Src;
                    } else {
                        $W = $W_Src;
                        $H = $W_Src;
                    }
                }
                // ------------------------
                // creation de la ressource-image "Src" en fonction de l extension
                switch ($extension_Src) {
                    case 'jpg':
                    case 'jpeg':
                        $Ress_Src = imagecreatefromjpeg($rep_Src . $img_Src);
                        break;
                    case 'png':
                        $Ress_Src = imagecreatefrompng($rep_Src . $img_Src);
                        break;
                }
                // ---------------------
                // creation d une ressource-image "Dst" aux dimensions finales
                // fond noir (par defaut)
                switch ($extension_Src) {
                    case 'jpg':
                    case 'jpeg':
                        $Ress_Dst = imagecreatetruecolor($W, $H);
                        // fond blanc
                        $blanc = imagecolorallocate($Ress_Dst, 255, 255, 255);
                        imagefill($Ress_Dst, 0, 0, $blanc);
                        break;
                    case 'png':
                        $Ress_Dst = imagecreatetruecolor($W, $H);
                        // fond transparent (pour les png avec transparence)
                        imagesavealpha($Ress_Dst, true);
                        $trans_color = imagecolorallocatealpha($Ress_Dst, 0, 0, 0, 127);
                        imagefill($Ress_Dst, 0, 0, $trans_color);
                        break;
                }
                // ------------------------
                // CENTRAGE du crop
                // coordonnees du point d origine Scr : $X_Src, $Y_Src
                // coordonnees du point d origine Dst : $X_Dst, $Y_Dst
                // dimensions de la portion copiee : $W_copy, $H_copy
                // ------------------------
                // CENTRAGE en largeur
                if ($W_fin == 0) {
                    if ($H_fin == 0 && $W_Src < $H_Src) {
                        $X_Src = 0;
                        $X_Dst = 0;
                        $W_copy = $W_Src;
                    } else {
                        $X_Src = 0;
                        $X_Dst = ($W - $W_Src) / 2;
                        $W_copy = $W_Src;
                    }
                } else {
                    if ($W_Src > $W) {
                        $X_Src = ($W_Src - $W) / 2;
                        $X_Dst = 0;
                        $W_copy = $W;
                    } else {
                        $X_Src = 0;
                        $X_Dst = ($W - $W_Src) / 2;
                        $W_copy = $W_Src;
                    }
                }
                // ------------------------
                // CENTRAGE en hauteur
                if ($H_fin == 0) {
                    if ($W_fin == 0 && $H_Src < $W_Src) {
                        $Y_Src = 0;
                        $Y_Dst = 0;
                        $H_copy = $H_Src;
                    } else {
                        $Y_Src = 0;
                        $Y_Dst = ($H - $H_Src) / 2;
                        $H_copy = $H_Src;
                    }
                } else {
                    if ($H_Src > $H) {
                        $Y_Src = ($H_Src - $H) / 2;
                        $Y_Dst = 0;
                        $H_copy = $H;
                    } else {
                        $Y_Src = 0;
                        $Y_Dst = ($H - $H_Src) / 2;
                        $H_copy = $H_Src;
                    }
                }
                // ------------------------------------------------
                // CROP par copie de la portion d image selectionnee
                imagecopyresampled($Ress_Dst, $Ress_Src, $X_Dst, $Y_Dst, $X_Src, $Y_Src, $W_copy, $H_copy, $W_copy, $H_copy);
                // ------------------------------------------------
                // ENREGISTREMENT dans le repertoire (avec la fonction appropriee)
                switch ($extension_Src) {
                    case 'jpg':
                    case 'jpeg':
                        imagejpeg($Ress_Dst, $rep_Dst . $img_Dst);
                        break;
                    case 'png':
                        imagepng($Ress_Dst, $rep_Dst . $img_Dst);
                        break;
                }
                // ---------------------
                // liberation des ressources-image
                imagedestroy($Ress_Src);
                imagedestroy($Ress_Dst);
                // ---------------------
                $condition = 1;
            }
        }
    }


    /**
     * Fonction d AJOUT DE TEXTE a une image et Enregistrement
     *
     * @param $chaine   TEXTE a Ajouter
     * @param $rep_Dst  repertoire de l'image de Destination
     * @param $img_Dst  NOM de l'image de Destination
     * @param $rep_Src  repertoire de l'image Source
     * @param $img_Src  NOM de l'image Source
     * @param $position position du texte sur l'image
     *                  $position = 'HG' --> en Haut a Gauche (valeur par defaut)
     *                  $position = 'HD' --> en Haut a Droite
     *                  $position = 'HC' --> en Haut au Centre
     *                  $position = 'BG' --> en Bas a Gauche
     *                  $position = 'BD' --> en Bas a Droite
     *                  $position = 'BC' --> en Bas au Centre
     *                  $position = 'CC' --> Au Centre au Centre
     * @image bool      Pour ajouter le logo comme watermark
     * @return bool
     */
    function picto ($chaine, $rep_Dst, $img_Dst, $rep_Src, $img_Src, $position = '', $image = false)
    {
        $condition = 0;
        $position = strtoupper($position); // on met en majuscule (par defaut)
        // Si certains paramètres ont pour valeur '' :
        if ($rep_Dst == '') {
            $rep_Dst = $rep_Src;
        } // (même répertoire)
        if ($img_Dst == '') {
            $img_Dst = $img_Src;
        } // (même nom)
        if ($position == '') {
            $position = 'BG';
        } // en Bas A Gauche (valeur par defaut)
        // ---------------------
        // si le fichier existe dans le répertoire, on continue...
        if (file_exists($rep_Src . $img_Src)) {
            // ----------------------
            // extensions acceptées :
            $extension_Allowed = 'jpg,jpeg,png';    // (sans espaces)
            // extension fichier Source
            $extension_Src = strtolower(pathinfo($img_Src, PATHINFO_EXTENSION));
            // ----------------------
            // extension OK ? on continue ...
            if (in_array($extension_Src, explode(',', $extension_Allowed))) {
                // ---------------------
                // récupération des dimensions de l'image Src
                $img_size = getimagesize($rep_Src . $img_Src);
                $W_Src = $img_size[0]; // largeur
                $H_Src = $img_size[1]; // hauteur
                // ---------------------
                // creation de la ressource-image "Dst" en fonction de l extension
                // (a partir de l'image source)
                switch ($extension_Src) {
                    case 'jpg':
                    case 'jpeg':
                        $Ress_Dst = imagecreatefromjpeg($rep_Src . $img_Src);
                        break;
                    case 'png':
                        $Ress_Dst = imagecreatefrompng($rep_Src . $img_Src);
                        break;
                }


                if ($image) {
                    $watermark = Config::getInstance()->get('app_url') . '/assets/img/favicon.png';
                    $extension_Wtm = strtolower(pathinfo($watermark, PATHINFO_EXTENSION));

                    $img_size = getimagesize($watermark);
                    $W = $img_size[0] - 5; // largeur
                    $H = $img_size[1] - 5; // hauteur

                    switch ($extension_Wtm) {
                        case 'jpg':
                        case 'jpeg':
                            $Ress_Txt = imagecreatefromjpeg($watermark);
                            break;
                        case 'png':
                            $Ress_Txt = imagecreatefrompng($watermark);
                            break;
                    }

                } else {
                    if ($chaine == '' || is_null($chaine) || $chaine == null) {
                        $chaine = Config::getInstance()->get('app_name');
                    }
                    // ------------------------------------------------
                    // creation de l'image TEXTE
                    // ------------------------------------------------
                    // dimension de l'image "Txt" en fonction :
                    // - de la longueur du texte a afficher
                    // - des dimensions des caracteres (7x15 pixels par caractère)
                    // ATTENTION : si le texte est TROP long, il risque d'être tronqué !
                    $W = strlen($chaine) * 7;
                    if ($W > $W_Src) {
                        $W = $W_Src;
                    }
                    $H = 15; // 15 pixels de haut (par defaut)
                    // ---------------------
                    // creation de la ressource-image "Txt" (en fonction de l extension)
                    switch ($extension_Src) {
                        case 'jpg':
                        case 'jpeg':
                        case 'png':
                            $Ress_Txt = imagecreatetruecolor($W, $H);
                            // Couleur du Fond : blanc
                            $blanc = imagecolorallocate($Ress_Txt, 255, 255, 255);
                            imagefill($Ress_Txt, 0, 0, $blanc);
                            // Couleur du Texte : noir
                            $textcolor = imagecolorallocate($Ress_Txt, 0, 0, 0);
                            // Ecriture du TEXTE
                            imagestring($Ress_Txt, 3, 0, 0, $chaine, $textcolor);
                            break;
                    }
                }


                // ------------------------------------------------
                // positionnement du TEXTE sur l'image
                // ------------------------------------------------
                if ($position == 'HG') {
                    $X_Dest = 0;
                    $Y_Dest = 0;
                }
                if ($position == 'HD') {
                    $X_Dest = $W_Src - $W;
                    $Y_Dest = 0;
                }
                if ($position == 'HC') {
                    $X_Dest = ($W_Src - $W) / 2;
                    $Y_Dest = 0;
                }
                if ($position == 'BG') {
                    $X_Dest = 0;
                    $Y_Dest = $H_Src - $H;
                }
                if ($position == 'BD') {
                    $X_Dest = $W_Src - $W;
                    $Y_Dest = $H_Src - $H;
                }
                if ($position == 'BC') {
                    $X_Dest = ($W_Src - $W) / 2;
                    $Y_Dest = $H_Src - $H;
                }
                if ($position == 'CC') {
                    $X_Dest = ($W_Src - $W) / 2;
                    $Y_Dest = ($H_Src - $H) / 2;
                }
                // ------------------------------------------------
                // copie par fusion de l'image "Txt" sur l'image "Dst"
                // (avec transparence de 50%)
                imagecopymerge($Ress_Dst, $Ress_Txt, $X_Dest, $Y_Dest, 0, 0, $W, $H, 30);
                // ------------------------------------------------
                // ENREGISTREMENT dans le repertoire (en fonction de l extension)
                switch ($extension_Src) {
                    case 'jpg':
                    case 'jpeg':
                        imagejpeg($Ress_Dst, $rep_Dst . $img_Dst);
                        break;
                    case 'png':
                        imagepng($Ress_Dst, $rep_Dst . $img_Dst);
                        break;
                }
                // ---------------------
                // liberation des ressources-image
                imagedestroy($Ress_Txt);
                imagedestroy($Ress_Dst);
                // ---------------------
                $condition = 1;
            }
        }
        // ---------------------------------------------------
        // retourne : true si le redimensionnement et l'enregistrement ont bien eu lieu, sinon false
        if ($condition == 1 && file_exists($rep_Dst . $img_Dst)) {
            return true;
        } else {
            return false;
        }
        // ---------------------------------------------------
    }


    /**
     * @param $type
     * @return string
     */
    public function getUploadExtension ($type)
    {
        foreach ($this->upload_extension($type) as $extent) {
            $this->extList .= $extent . ', ';
        }
        $this->extList = trim($this->extList);
        return trim($this->extList, ',');
    }


    /**
     * @param $dir_name
     * @return bool|string
     * Function qui permet de creer le dossier destinataire des fichiers uploader
     */
    public function createUploadFolder ($dir_name)
    {
        $this->upload_dir = Config::getInstance()->get('upload_directory');
        $upload_directory = $this->upload_dir . '/' . $dir_name . '/';

        if (!is_dir($upload_directory)) {
            mkdir($this->upload_dir . '/' . $dir_name . '/', 0777, true);
            $upload_directory = $this->upload_dir . '/' . $dir_name . '/';
        }

        return $upload_directory;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function generateName ()
    {
        return (bin2hex(random_bytes(16)));
    }

    /**
     * @param       $file
     * @param       $id
     * @param array $options
     * @param array $erreurs
     * @return null
     */
    public function savePicture ($file, $id, $options = [], $erreurs = [])
    {
        $autorist_file_type = isset($options['autorist_file_type']) ? $options['autorist_file_type'] : 'all';
        $file_name = isset($options['file_name']) ? $options['file_name'] : $this->generateName();
        $directory = isset($options['directory']) ? $options['directory'] : false;
        $resize = isset($options['resize']) ? $options['resize'] : false;
        $resize_type = isset($options['resize_type']) ? $options['resize_type'] : 'Ratio';
        $resize_w_size = isset($options['resize_w_size']) ? $options['resize_w_size'] : null;
        $resize_h_size = isset($options['resize_h_size']) ? $options['resize_h_size'] : null;
        $thumbnail = isset($options['thumbnail']) ? $options['thumbnail'] : false;
        $thumbnail_w_size = isset($options['thumbnail_w_size']) ? $options['thumbnail_w_size'] : $this->thumbnail_size;
        $thumbnail_h_size = isset($options['thumbnail_h_size']) ? $options['thumbnail_h_size'] : $this->thumbnail_size;
        $watermark = isset($options['watermark']) ? $options['watermark'] : false;
        $watermark_img = isset($options['watermark_img']) ? $options['watermark_img'] : false;
        $watermark_position = isset($options['watermark_position']) ? $options['watermark_position'] : null;
        $watermark_txt = isset($options['watermark_txt']) ? $options['watermark_txt'] : Config::getInstance()->get('app_name');

        //Recuperation des dimension de l'image actuelle
        if ($resize) {
            list($width, $height) = getimagesize($_FILES[$file]["tmp_name"]);
            if ($resize_w_size == null && $resize_h_size == null) {
                $resize_w_size = $width / 2;
                $resize_h_size = $height / 2;
            } elseif ($resize_h_size == null) {
                $resize_h_size = $height / 2;
            } elseif ($resize_w_size == null) {
                $resize_w_size = $width / 2;
            }

        }

        if ($_FILES[$file]['error'] != UPLOAD_ERR_NO_FILE) {

            $this->upload_max_size = Config::getInstance()->get('upload_max_size');

            if ($_FILES[$file]['size'] <= $this->upload_max_size) {

                $path_parts = pathinfo($_FILES[$file]['name']);
                $extension_upload = strtolower($path_parts['extension']);

                if (in_array($extension_upload, $this->upload_extension($autorist_file_type))) {

                    if (!isset($resize_w_size, $resize_h_size) || (($width > $resize_w_size) && ($height > $resize_h_size))) {

                        //Creation du dossier de l'image a partir de l'id de l'annonce
                        if ($directory) {
                            $upload_directory = $this->createUploadFolder($directory);
                        } else {
                            $upload_directory = $this->createUploadFolder('picture');
                        }

                        //deplacement de l'image source dans le dossier destinataire
                        if (move_uploaded_file($_FILES[$file]['tmp_name'], $upload_directory . $_FILES[$file]['name'])) {

                            //renommage de l'image
                            $newName = $file_name . $id . '.' . $extension_upload;
                            $oldName = $upload_directory . $_FILES[$file]['name'];
                            $newFile = $upload_directory . $newName;

                            if (rename($oldName, $newFile)) {

                                if ($watermark) {
                                    $this->picto($watermark_txt, $upload_directory, $newName, $upload_directory, $newName, $watermark_position, $watermark_img);
                                }

                                //Création de la miniature s'il est préciser dans les paramètre
                                if ($thumbnail) {

                                    //Creation du dossier de l'image a partir de l'id de l'annonce
                                    if ($directory) {
                                        $thumbnail_directory = $this->createUploadFolder($directory . '/thumbnail');
                                    } else {
                                        $thumbnail_directory = $this->createUploadFolder('picture/thumbnail');
                                    }

                                    $thumbnail_name = 'min_' . $newName;
                                    $this->resizeCenter(0, 0, $thumbnail_directory, $thumbnail_name, $upload_directory, $newName);
                                    $this->resizeRatio($thumbnail_w_size, $thumbnail_h_size, $thumbnail_directory, $thumbnail_name, $thumbnail_directory, $thumbnail_name);
                                    if ($watermark) {
                                        $this->picto($watermark_txt, $upload_directory, $newName, $upload_directory, $newName, $watermark_position, $watermark_img);
                                    }
                                } //Redimentionnement
                                elseif ($resize) {
                                    //Creation du dossier de l'image a partir de l'id de l'annonce
                                    if ($directory) {
                                        $resize_directory = $this->createUploadFolder($directory . '/resize');
                                    } else {
                                        $resize_directory = $this->createUploadFolder('picture/resize');
                                    }

                                    if ($resize && ucfirst($resize_type) === 'Ratio') {
                                        $this->resizeRatio($resize_w_size, $resize_h_size, $resize_directory, $newName, $upload_directory, $newName);
                                        if ($watermark) {
                                            $this->picto($watermark_txt, $upload_directory, $newName, $upload_directory, $newName, $watermark_position, $watermark_img);
                                        }
                                    }

                                    if ($resize && ucfirst($resize_type) === 'Center') {
                                        //Recuperation des dimensions de l'image
                                        list($width, $height) = getimagesize($newFile);
                                        $new_w_size = $resize_w_size + 100;
                                        $new_h_size = $resize_h_size + 100;
                                        $resize_w_size2 = ($width < $resize_w_size) ? $new_w_size : $resize_w_size;
                                        $resize_h_size2 = ($height < $resize_h_size) ? $new_h_size : $resize_h_size;
                                        $this->resizeRatio($new_w_size, $new_h_size, $resize_directory, '', $upload_directory, $newName);
                                        $this->resizeCenter($resize_w_size2, $resize_h_size2, $resize_directory, '', $resize_directory, $newName);
                                        $this->resizeRatio($resize_w_size, $resize_h_size, $resize_directory, '', $resize_directory, $newName);
                                        if ($watermark) {
                                            $this->picto($watermark_txt, $upload_directory, $newName, $upload_directory, $newName, $watermark_position, $watermark_img);
                                        }
                                    }
                                }

                                return $newName;
                            } else {
                                $erreurs[] = 'Impossible de renommer le fichier';
                            }

                        } else {
                            $erreurs[] = "Impossible de copier le fichier dans le dossier upload du serveur.";
                        }
                    } else {
                        $erreurs[] = "Dimension de l'image inférieure. L'image doit faire avoir une dimension supérieure à $resize_w_size x $resize_h_size ";
                    }

                } else {
                    $erreurs[] = "Le fichier pas les bonnes extensions. Les extensions acceptées sont les suivantes: " . $this->getUploadExtension($autorist_file_type);
                }

            } else {
                $erreurs[] = "Le fichier est trop gros. Taille maximal 5 Mo.";
            }

        }

        if (count($erreurs) == 0 && isset($newName)) {
            return $newName;
        } elseif (count($erreurs) == 0 && !isset($newName)) {
            return null;
        } else {
            return $erreurs;
        }
    }

    /**
     * @param $type
     * @return array
     */
    protected function upload_extension ($type)
    {
        if ($type === 'picture') {
            $extension = ['jpg', 'jpeg', 'png'];
        } elseif ($type === 'doc') {
            $extension = ['txt', 'doc', 'ppt', 'xls', 'pdf', 'odt', 'docx', 'xlsx', 'pptx'];
        } elseif ($type === 'all') {
            $extension = ['jpg', 'gif', 'png', 'txt', 'doc', 'ppt', 'xls', 'pdf', 'odt', 'docx',
                'xlsx', 'pptx', 'psd'];
        } else {
            $extension = ['jpg', 'gif', 'png', 'txt', 'doc', 'ppt', 'xls', 'pdf', 'odt', 'docx',
                'xlsx', 'pptx', 'psd'];
        }
        return $extension;
    }

}