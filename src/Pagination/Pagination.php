<?php

namespace Core\Pagination;


use App\App;

/**
 * Class Pagination
 *
 * @package Core\Pagination
 */
class Pagination
{
    /**
     * @var
     */
    private static $_instance;

    /**
     * @return Pagination
     */
    public static function getInstance ()
    {
        if (self::$_instance === null) {
            self::$_instance = new Pagination();
        }
        return self::$_instance;
    }

    /**
     * @param       $nbre_vue
     * @param       $table
     * @param array $option
     * @param null  $search
     * @return mixed
     */
    public function pagination ($nbre_vue, $table, $option = [], $search = null)
    {
        //Compter le nombre total de ligne dans la table
        if (isset($search) && $search != '') {
            $all = App::getInstance()->getTable($table)->MySearch($option, $search);
            $all = count($all);
        } else {
            if (count($option) > 0) {
                $all = App::getInstance()->getTable($table)->MyCount(null, $option);
            } else {
                $all = App::getInstance()->getTable($table)->MyCount();
            }
        }

        $nb_page = ceil($all / $nbre_vue);

        $pagination ['nb_page'] = $nb_page;

        //Page actuelle
        if (isset($_GET['p']) && !empty($_GET['p']) && is_numeric($_GET['p']) == 1) {
            if ($_GET['p'] > $nb_page) {
                $currentPage = $nb_page;
            } elseif ($_GET['p'] < 0) {
                $currentPage = $nb_page;
            } else {
                $currentPage = $_GET['p'];
            }
        } else {
            $currentPage = 1;
        }
        $pagination ['currentPage'] = $currentPage;

        return $pagination;
    }

    /**
     * @param $currentPage
     * @param $nb_page
     * @param $page
     */
    public function paginationView ($currentPage, $nb_page, $page)
    {
        echo '<nav aria-label="Page navigation example">';
        echo '<ul class="pagination justify-content-end">';
        echo '<li class="page-item">';
        if ($currentPage > 1) {
            echo '<a class="page-link" href="' . App::getInstance()->app_info('app_url') . $page . '/' . ($currentPage - 1) . '/page" aria-label="Précédent">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Précédent</span>
            </a>';
        } else {
            echo '<a class="page-link" href="" aria-label="Précédent">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Précédent</span>
            </a>';
        }
        echo '</li>';

        for ($i = 1; $i <= $nb_page; $i++) {
            if ($i == $currentPage) {
                echo ' <li class="page-item active"><a class="page-link" href="">' . $i . '</a> </li> ';
            } else {
                echo '<li class="page-item"><a class="page-link" href="' . App::getInstance()->app_info('app_url') . $page . '/' . $i . '/page ">' . $i . '</a> </li>';
            }
        }

        //affichage des pages
        echo '<li class="page-item">';
        if ($currentPage < $nb_page) {
            echo '<a aria-label="Suivant" class="page-link" href="' . App::getInstance()->app_info('app_url') . $page . '/' . ($currentPage + 1) . '/page"><span aria-hidden="true">&raquo;</span>
<span class="sr-only">Suivant</span></a>';
        } else {
            echo '<a class="page-link" aria-label="Suivant" href="">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Suivant</span>
            </a>';
        }
        echo '</li>';
        echo '</ul>';
        echo '</nav>';
    }
}