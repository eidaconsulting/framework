<?php

namespace App\Controller\Publics;


class NotfoundController extends \App\Controller\AppController {

    public function __construct() {
        parent::__construct();
        //$this->loadModel('User');
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
        $page_titre = 'Page Introuvable';

        $back_url = null;
        if(isset($_SERVER['HTTP_REFERER'])){
            $back_url = $_SERVER['HTTP_REFERER'];
        }
        $this->render('publics.notfound', compact('styleCSS', 'javascript',
            'page_titre', 'back_url'));
    }

}