<?php

namespace App\Controller\Admins;


class IndexController extends \App\Controller\AppController {

    public function __construct() {
        parent::__construct();

        $this->loadModel('Admin');
    }

    private function css(){
        $css = '<link href="'.$this->entity()->css_file("style-admin.css").'" rel="stylesheet">';
        $css .= '<link href="'.$this->entity()->vendor_file("dataTables/datatables.min.css").'" rel="stylesheet">';
        return $css;
    }

    private function js(){
        $js = '<script src="'.$this->entity()->vendor_file("dataTables/datatables.min.js").'"></script>';
        $js .= '<script src="'.$this->entity()->js_file("my.datatables.js").'"></script>';
        return $js;
    }

    public function view(){
        $styleCSS =  $this->css();
        $javascript = $this->js();
        $page = 'index';
        $page_titre = 'Votre espace d\'administration';

        $this->render('admins.'.$page, compact('page_titre', 'styleCSS', 'javascript'));
    }
}