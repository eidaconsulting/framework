<?php

namespace Modules\Blogs\Publics;


use Core\Controller\Controller;
use App\App;
use Core\Form\BootstrapForm;
use Core\Pagination\Pagination;
use Modules\Blogs\AppController;


class CategoriesController extends AppController
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


    public function view($id, $slug){

        $styleCSS = $this->css();
        $javascript = $this->js();

        $nb_vue = 20;
        $pagination = Pagination::getInstance()->pagination($nb_vue, 'Blog', ['category_id' => $id]);
        $currentPage = 1;
        $nb_page = $pagination['nb_page'];
        $firstOfListe = ($currentPage - 1) * $nb_vue;

        $datas = $this->Blog->MyLim($firstOfListe, $nb_vue, ['category_id' => $id]);
        $categories = $this->Blogcategorie->MyAll();
        $page_titre = 'Catégorie '.$this->entity()->nameFromID('Blogcategorie', $id)->category;
        $pageName = 'Publications dans : ' . $this->entity()->nameFromID('Blogcategorie', $id)->category;
        $pageUrl = '/blogs/categorie/'. $slug . '/' . $id;

        $form = new BootstrapForm($_POST);

        $this->render('publics.index', compact('styleCSS', 'javascript',
            'page_titre', 'form', 'datas', 'categories', 'pageName', 'nb_page', 'currentPage', 'pageUrl'));

    }

    public function pages($id, $slug, $page){

        $styleCSS =  $this->css();
        $javascript = $this->js();
        $nb_vue = 20;
        $pagination = Pagination::getInstance()->pagination($nb_vue, 'Blog', ['category_id' => $id]);
        $currentPage = $page;
        $nb_page = $pagination['nb_page'];
        $firstOfListe = ($currentPage - 1) * $nb_vue;

        $datas = $this->Blog->MyLim($firstOfListe, $nb_vue, ['category_id' => $id]);
        $categories = $this->Blogcategorie->MyAll();
        $page_titre = 'Catégorie '.$this->entity()->nameFromID('Blogcategorie', $id)->category;
        $pageName = 'Publications dans : ' . $this->entity()->nameFromID('Blogcategorie', $id)->category;
        $pageUrl = '/blogs/categorie/'. $id. '/' . $slug  ;

        $form = new BootstrapForm($_POST);

        $this->render('publics.index', compact('styleCSS', 'javascript',
            'page_titre', 'form', 'datas', 'categories', 'pageName', 'currentPage', 'nb_page',
            'pageUrl'));

    }

}