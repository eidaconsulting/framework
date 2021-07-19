<?php

namespace App\Controller\Publics;

use App\App;
use Core\Form\BootstrapForm;
use function Couchbase\defaultDecoder;

class IndexController extends \App\Controller\AppController {

    public function __construct() {
        parent::__construct();
        $this->loadModel('Admin');
    }

    protected function css(){
        $css = '';

        return $css;
    }

    protected function js(){
        $js = '';

        return $js;
    }

    protected function description($description = null){
        if(!is_null($description)){
            return $description;
        }
        return App::getInstance()->app_info('app_description');
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