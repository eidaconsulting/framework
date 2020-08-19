<?php

namespace App\Controller\Users;

use App\Controller\AppController;

class IndexController extends AppController {

    public function __construct() {
        parent::__construct();

        $this->loadModel('User');
        $this->loadModel('Profil');
    }

    public function css(){
        $css = '';
        return $css;
    }

    public function js(){
        $js = '';
        return $js;
    }

    public function view(){
        $styleCSS =  $this->css();
        $javascript = $this->js();

        $page_titre = 'Votre espace Utilisateur';

        $this->render('users.index', compact('page_titre', 'javascript', 'styleCSS'));
    }

}