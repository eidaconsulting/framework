<?php

namespace App\Controller\Publics;

use Core\Controller\Controller;
use App\App;
use Core\Form\BootstrapForm;

class IndexController extends \App\Controller\AppController {

    public function __construct() {
        parent::__construct();
        //$this->loadModel('Product');
    }

    private function css(){
        $css = '';

        return $css;
    }

    private function js(){
        $js = '';

        return $js;
    }

    public function view(){
        $styleCSS = $this->css();
        $javascript = $this->js();
        $page_titre = '';
        $form = new BootstrapForm($_POST);
        $page = '';
        $description = "";
        $og_picture = "";

        $this->render('publics.index', compact('styleCSS', 'javascript',
            'page_titre', 'form', 'page', 'description', 'og_picture'));
    }

}