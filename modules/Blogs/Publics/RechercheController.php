<?php

namespace Modules\Blogs\Publics;


use Core\Caches\Cache;
use Core\Controller\Controller;
use App\App;
use Core\Form\BootstrapForm;
use Core\Search\Search;
use Core\Pagination\Pagination;
use Modules\Blogs\AppController;


class RechercheController extends AppController
{

    public function __construct() {
        parent::__construct();
        $this->loadModel('Blogcategorie');
        $this->loadModel('Blog');
        $this->loadModel('Comment');
    }

    private function css() {
        $css = '';
        return $css;
    }

    private function js() {
        $js = '';
        return $js;
    }


    public function view(){

        $styleCSS = $this->css();
        $javascript = $this->js();

        if(isset($_POST) && array_key_exists('search-blog', $_POST)){

            $search = New Search();
            extract($this->secureData($_POST));

            $nb_vue = 20;
            $pagination = Pagination::getInstance()->pagination($nb_vue, 'Blog', ['content' => $blogQuery, 'title' => $blogQuery], ' OR ');

            $currentPage = 1;
            $nb_page = $pagination['nb_page'];
            $firstOfListe = ($currentPage - 1) * $nb_vue;

            $pageUrl = '/blogs/search/'.$blogQuery;
            $lim = $firstOfListe .', '.$nb_vue;

            $datas = $search->search('blog', ['content' => $blogQuery, 'title' => $blogQuery], 'OR', $lim);
            $categories = $this->Blogcategorie->MyAll();
            $page_titre = 'Resultat pour ' . $blogQuery;
            $pageName = 'Résultat pour : ' . $blogQuery;

            $form = new BootstrapForm($_POST);
            $cache = new Cache();
            $cache->deleteFile($_SERVER['REQUEST_URI']);

            $this->render('publics.index', compact('styleCSS', 'javascript',
                'page_titre', 'form', 'datas', 'categories', 'pageName', 'nb_page', 'currentPage', 'pageUrl'));
        }
        else {
            $redirect = $this->entity()->blogs('');
            $this->redirection($redirect);
        }


    }


    public function pages($slug, $id){

        $search = New Search();
        extract($this->secureData($_POST));
        $styleCSS =  $this->css();
        $javascript = $this->js();

        $nb_vue = 20;
        $pagination = Pagination::getInstance()->pagination($nb_vue, 'Blog', ['content' => $slug, 'title' => $slug], ' OR ');
        $currentPage = $id;
        $nb_page = $pagination['nb_page'];
        $firstOfListe = ($currentPage - 1) * $nb_vue;

        $pageUrl = '/blogs/search/'.$slug;
        $lim = $firstOfListe .', '.$nb_vue;

        $datas = $search->search('blog', ['content' => $slug, 'title' => $slug], 'OR', $lim);
        $categories = $this->Blogcategorie->MyAll();
        $page_titre = 'Resultat pour ' . $slug;
        $pageName = 'Résultat pour : ' . $slug;

        $form = new BootstrapForm($_POST);

        $this->render('publics.index', compact('styleCSS', 'javascript',
            'page_titre', 'form', 'datas', 'categories', 'pageName', 'nb_page', 'currentPage', 'pageUrl'));

    }

}