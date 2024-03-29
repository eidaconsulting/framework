<?php

namespace Core\Entity;

use App\App;
use Core\Config;

/**
 * Class Entity
 *
 * @package Core\Entity
 */
class Entity
{
    /**
     * Function permettant de d'ajouter automatiquement un get a une methode qu'on appel et qui n'existe pas
     * Exemple : si j'appel $article->url, automatiquement cette function appelle la methode
     * $article->getUrl()
     * @param $key : Le nom de la clé ou de l'evenement appelé
     * @return mixed
     */
    public function __get ($key)
    {
        $method = 'get' . ucfirst($key);
        $this->$key = $this->$method();
        return $this->$key;
    }


    /**
     * It Display money depending on the currency
     * @param int $money : The money you want to display
     * @param string $currency : The currency ($, dollar, € or euro)
     * @return string : return the money converted according to the
     *                  currency with the correct format
     */
    public function getCurrency (int $money, string $currency = ''): string
    {
        if ($currency != '') {
            if ($currency === '€' || $currency === 'euro') {
                return '€ ' . number_format($money / 655.96, 2, ',', ' ');
            } elseif ($currency === '$' || $currency === 'dollar') {
                return '$ ' . number_format($money / 595.24, 2, ',', '.');
            }
        } else {
            return number_format($money, 0, '', ' ') . ' ' . $this->app_info('currency');
        }
    }

    /**
     * To get any information in the config file
     * @param $info : is the array key in the config file
     * @return mixed|null
     */
    public function app_info ($info)
    {
        return Config::getInstance()->get($info);
    }

    /**
     * Allows to retrieve an extract from a text
     * @param $length  : the number of characters we want to display in the text.
     * @param $mark    : the mark to put at the end of the text to signify that
     *                 it continues and that it is part of an even longer text
     * @param $content : the text of which we want to display a part
     * @return string : Return the shortened text
     */
    public function getExtract (int $length, string $mark, string $content): string
    {
        $text = html_entity_decode($content);
        $text = strip_tags($text);
        $text = substr($text, 0, $length);
        $text = substr($text, 0, strrpos($text, " "));
        $text = $text . $mark;
        return $text;
    }

    /**
     * Retourne une date formatée en fonction du paramettre date
     *
     * @param $datetime : Date au format datatime (AAAA-MM-JJ HH-MM-SS)
     * @return string
     */
    public function dateFormat (string $datetime, $type = null): string
    {
        if($datetime != ''){

            if(count(explode(" ", $datetime)) == 1){
                $datetime = $datetime. ' 23:59:59';
            }

            list($date, $time) = explode(" ", $datetime);
            list($year, $month, $day) = explode("-", $date);
            list($hour, $min, $sec) = explode(":", $time);
            $months = array("Janv", "Fév", "Mars", "Avr", "Mai", "Juin", "Juil", "Août", "Sept", "Oct", "Nov", "Déc");

            if (isset($type)) {
                //Format 12/12/12
                if ($type === 'jj/mm/yy') {
                    $datetime = "$day/$month/$year";
                } //Format 12/12/12 5:5
                elseif($type === 'jj.mm.yy'){
                    $datetime = "$day.$month.$year";
                }
                elseif ($type === 'jj/mm/yy h:m') {
                    $datetime = "$day/$month/$year ${hour}:${min}";
                } //Format 12/12/12 5:5:5
                elseif ($type === 'jj/mm/yy h:m:s') {
                    $datetime = "$day/$month/$year ${hour}:${min}:${sec}";
                } //Format 12 Janv 2015 5h5m5s
                elseif ($type === 'jj mmmm yyyy hhmmss') {
                    $datetime = "$day " . $months[$month - 1] . " $year ${hour}h${min}m${sec}s";
                } //Format Janv 2015
                elseif ($type === 'mmmm yyyy') {
                    $datetime = $months[$month - 1] . " $year";
                } //Format 12 Janv 2015 5h5m
                elseif ($type === 'jj mmmm yyyy hhmm') {
                    $datetime = "$day " . $months[$month - 1] . " $year ${hour}h${min}m";
                } //Format 12 Janv 2015
                elseif ($type === 'jj mmmm yyyy') {
                    $datetime = "$day " . $months[$month - 1] . " $year";
                }

            } else {
                $datetime = "$day " . $months[$month - 1] . " $year";
            }
        }
        else {
            $datetime = '';
        }

        return $datetime;
    }

    /**
     * @param      $picture
     * @param      $taille
     * @param bool $directory
     */
    public function miniature ($picture, $H_taille, $W_taille, $directory = false, $class = 'img-responsive')
    {

        if ($picture == '' || $picture == null) {
            $picture_url = $this->img_file('default.png');
            $image = $this->pictureScreen($picture_url, $H_taille, $W_taille, $class);
        } else {
            if ($directory) {
                $picture_url = $this->uploads($directory) . '/' . $picture;
            } else {
                $picture_url = $this->uploads('uploads') . '/' . $picture;
            }

            $image = $this->pictureScreen($picture_url, $H_taille, $W_taille, $class);
        }
        return $image;
    }

    /**
     * @param $file
     * @return string
     */
    public function img_file ($file)
    {
        return $this->url() . '/assets/img/' . $file;
    }

    /**
     * @return mixed|null
     */
    public function url ()
    {
        return Config::getInstance()->get('app_url');
    }

    /**
     * Fonction d'affichage des images dans le viewers
     * Affiche :  src="..." width="..." height="..." pour la balise img
     *
     * @param $img_Src : URL (chemin + NOM) de l'image Source
     * @param $W_max   : La largeur maximale
     * @param $H_max   : La hauteur maximale
     */
    public function pictureScreen ($img_Src, $W_max, $H_max, $class)
    {
        $handle = @fopen($img_Src, "r");
        if ($handle) {
            // ----------------------------------------------------
            // Lit les dimensions de l'image source
            $img_size = GetImageSize($img_Src);
            $W_Src = $img_size[0]; // largeur source
            $H_Src = $img_size[1]; // hauteur source
            // ----------------------------------------------------
            if (!$W_max) {
                $W_max = 0;
            }
            if (!$H_max) {
                $H_max = 0;
            }
            // ----------------------------------------------------
            // Teste les dimensions tenant dans la zone
            $W_test = round($W_Src * ($H_max / $H_Src));
            $H_test = round($H_Src * ($W_max / $W_Src));
            // ----------------------------------------------------
            // si l image est plus petite que la zone
            if ($W_Src < $W_max && $H_Src < $H_max) {
                $W = $W_Src;
                $H = $H_Src;
                // sinon si $W_max et $H_max non definis
            } elseif ($W_max == 0 && $H_max == 0) {
                $W = $W_Src;
                $H = $H_Src;
                // sinon si $W_max libre
            } elseif ($W_max == 0) {
                $W = $W_test;
                $H = $H_max;
                // sinon si $H_max libre
            } elseif ($H_max == 0) {
                $W = $W_max;
                $H = $H_test;
                // sinon les dimensions qui tiennent dans la zone
            } elseif ($H_test > $H_max) {
                $W = $W_test;
                $H = $H_max;
            } else {
                $W = $W_max;
                $H = $H_test;
            }

            // ----------------------------------------------------
            // AFFICHE les dimensions optimales
            if ($W == $W_max && $H <= $H_max) {
                echo '<img src="' . $img_Src . '" height="' . $H_max . '" class="' . $class . '">';
            } elseif ($W <= $W_max && $H == $H_max) {
                echo '<img src="' . $img_Src . '" width="' . $W_max . '" class="' . $class . '">';
            } else {
                echo '<img src="' . $img_Src . '" width="' . $W . '" height="' . $H . '" class="' . $class . '">';
            }
            // ----------------------------------------------------
        } else { // si le fichier image n existe pas
            $W = 0;
            $H = 0;
        }
    }

    /**
     * @param $url
     * @return string
     */
    public function uploads ($url)
    {
        return Config::getInstance()->get('app_url') . '/' . Config::getInstance()->get('upload_directory') . '/' . $url;
    }

    /**
     * @param null $page
     * @return string
     */
    public function admins ($page = null)
    {
        if ($page == null) {
            return Config::getInstance()->get('app_url') . '/a/index';
        } else {
            return Config::getInstance()->get('app_url') . '/a/' . $page;
        }
    }

    /**
     * @param null $page
     * @return string
     */
    public function users ($page = null)
    {
        if ($page == null) {
            return Config::getInstance()->get('app_url') . '/u/index';
        } else {
            return Config::getInstance()->get('app_url') . '/u/' . $page;
        }
    }

    /**
     * @param null $page
     * @return mixed|string|null
     */
    public function publics ($page = null)
    {
        if ($page == null) {
            return Config::getInstance()->get('app_url');
        } else {
            return Config::getInstance()->get('app_url') . '/' . $page;
        }
    }

    /**
     * @param null $page
     * @return string
     */
    public function blogs ($page = null)
    {
        if ($page == null) {
            return Config::getInstance()->get('app_url') . '/blogs';
        } else {
            return Config::getInstance()->get('app_url') . '/blogs/' . $page;
        }

    }

    /**
     * @param string $type
     * @return string
     */
    public function social_url (string $type): string
    {
        return Config::getInstance()->get('app_' . $type .'_url');
    }

    /**
     * @param string $file
     * @return string
     */
    public function css_file (string $file): string
    {
        return $this->url() . '/assets/css/' . $file;
    }

    /**
     * @param string $file
     * @return string
     */
    public function js_file (string $file): string
    {
        return $this->url() . '/assets/js/' . $file;
    }

    /**
     * @param string $file
     * @return string
     */
    public function ajax_file (string $file): string
    {
        return $this->url() . '/assets/ajax/' . $file;
    }

    /**
     * @param string $file
     * @return string
     */
    public function vendor_file (string $file): string
    {
        return $this->url() . '/assets/vendor/' . $file;
    }

    /**
     * @param string $file
     * @return string
     */
    public function font_file (string $file): string
    {
        return $this->url() . '/assets/fonts/' . $file;
    }

    /**
     * Fonction qui permet de générer un menu automatiquemement
     *
     * @param array $items  Les menus sous forme de tableau
     * @param       $type   Le type de menu (publics, users, admins)
     */
    public function nav (array $items, $type)
    {
        if (count($items) > 0) {
            foreach ($items as $k => $item) {

                if (is_array($item)) {
                    $first = $k;
                    echo '
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  ' . ucfirst($first) . '
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
                    foreach ($item as $key => $value) {
                        $value = explode(',', $value);
                        if (isset($value[1])) {
                            $css = $value[1];
                        } else {
                            $css = null;
                        }
                        echo '<a class="dropdown-item ' . $css . ' ' . $this->is_current($key) . '"  href="' . $this->$type($key) . '">' . $value[0] . '</a>';
                    }

                    echo '
                                </div>
                              </li>
                            ';

                } else {
                    $item = explode(',', $item);
                    if (isset($item[1])) {
                        $css = $item[1];
                    } else {
                        $css = null;
                    }
                    echo '
                    <li class="nav-item">
                        <a class="nav-link ' . $css . ' ' . $this->is_current($k) . '" href="' . $this->$type($k) . '">' . $item[0] . '</a>
                    </li>
                ';
                }

            }
        } else {
            echo '
                <li class="nav-item active">
                    <a class="nav-link" href="' . $this->entity()->url() . '">Accueil</a>
                </li>
            ';
        }
    }

    /**
     * Return active class if is current nav item
     *
     * @param $param
     * @return string
     */
    public function is_current (string $param,bool $single = false): string
    {
        if(isset($single, $_GET['url']) && $single == true){
            $array = explode('/', $_GET['url']);
            if ($array[0] == $param) {
                return 'active';
            }
            else {
                return '';
            }
        }
        else {
            if (isset($_GET['url']) && $_GET['url'] == $param) {
                return 'active';
            }
            else {
                return '';
            }
        }

    }

    /**
     * @param $table
     * @param $id
     * @return mixed
     */
    public function nameFromID ($table, $id)
    {
        return App::getInstance()->getTable($table)->MyFind($id);
    }

    /**
     * @param $table
     * @param $options
     * @return mixed
     */
    public function nameFromTable ($table, $options)
    {
        return App::getInstance()->getTable($table)->MyWhere($options);
    }

    /**
     * @param       $table
     * @param null  $field
     * @param array $options
     * @return mixed
     */
    public function countData ($table, $field = null, $options = [])
    {
        return App::getInstance()->getTable($table)->MyCount($field, $options);
    }

    /**
     * Function qui permet de gerer l'affichages des alertes
     */
    public function notification ()
    {
        if (isset($_SESSION['notification']['message'])): ?>
            <div id="alert" class="is-alerte-message alert alert-<?= $_SESSION['notification']['type'] ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php if ($_SESSION['notification']['type'] == 'success'): ?>
                    <div class="alert-icone"><i class="fa fa-check"></i> &nbsp; <strong>Succès !</strong></div>
                <?php elseif ($_SESSION['notification']['type'] == 'danger'): ?>
                    <div class="alert-icone"><i class="fa fa-times-circle"></i> &nbsp; <strong>Erreur !</strong></div>
                <?php elseif ($_SESSION['notification']['type'] == 'info'): ?>
                    <div class="alert-icone"><i class="fa fa-info-circle"></i> &nbsp; <strong>Information !</strong>
                    </div>
                <?php elseif ($_SESSION['notification']['type'] == 'warning'): ?>
                    <div class="alert-icone"><i class="fa fa-exclamation-triangle"></i> &nbsp; <strong>Attention
                            !</strong></div>
                <?php else: ?>
                    <div class="alert-icone"><i class="fa fa-info-circle"></i> &nbsp; <strong>Information !</strong>
                    </div>
                <?php endif; ?>
                <?php if (is_array($_SESSION['notification']['message'])): ?>
                    <ul>
                        <?php foreach ($_SESSION['notification']['message'] as $message): ?>
                            <li><?= $message; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <span><?= $_SESSION['notification']['message'] ?></span>
                <?php endif; ?>
            </div>
            <?php $_SESSION['notification'] = []; ?>
        <?php endif;
    }


    /**
     * Gestion des icone des fichiers telecharger.
     *
     * @param $file
     * @return string
     */
    public function fileExtension (string $file): string
    {
        list($fileName, $extension) = explode('.', $file);
        $files = 'files/file-' . $extension;
        return '<img src="' . $this->img_file($files) . '" width="80px">';
    }


    /**
     * @return mixed
     */
    public function getIpAddress ()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }

    /**
     * @param $texte    Contenu à decodé
     * @return string   Return the decode text
     */
    public function decodeTexte ($texte)
    {
        return htmlspecialchars_decode($texte, ENT_HTML5);
    }

    /**
     * @param string $fichier
     * @return mixed
     */
    public function mega_include (string $fichier)
    {
        if (!empty($fichier)) {
            $fichier = trim($fichier . ".php");

            // On évite les caractères qui permettent de naviguer dans les répertoires
            $fichier = str_replace("../", "protect", $fichier);
            $fichier = str_replace(";", "protect", $fichier);
            $fichier = str_replace("%", "protect", $fichier);

            $file = $fichier;

            return $file;

        } else {
            echo "Fichier inexistant !";
        }
    }


    public function captcha ()
    {
        return '<div class="g-recaptcha" data-sitekey="' . Config::getInstance()->get("captcha_site_key") . '"></div>';
    }



}