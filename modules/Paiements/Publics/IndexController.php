<?php

namespace Modules\Paiements\Publics;


use Core\Controller\Controller;
use App\App;
use Core\Email\Email;
use Core\Form\BootstrapForm;
use Core\Pagination\Pagination;
use Modules\Paiements\AppController;


class IndexController extends AppController
{

    public function __construct() {
        parent::__construct();
        /*$this->loadModel('Blogcategorie');*/
    }

    protected function css() {
        $css = '<link href="'.$this->entity()->css_file("comment.css").'" rel="stylesheet">';
        return $css;
    }

    protected function js() {
        $js = '<script src="'.$this->entity()->js_file("comment.js").'"></script>';
        return $js;
    }


    public function view(){

        $page_titre = 'Formiulaire de paiements';
        $form = new BootstrapForm($_POST);

        $this->render('publics.index', compact('styleCSS', 'javascript',
            'page_titre', 'form'));

    }

}