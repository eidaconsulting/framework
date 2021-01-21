<?php

namespace App\Controller\Users;

use App\Controller\AppController;

class UserController extends AppController {

    public function __construct() {
        parent::__construct();

        $this->loadModel('User');
        $this->loadModel('Profil');
    }

    protected function css(){
        $css = '';
        return $css;
    }

    protected function js(){
        $js = '';
        return $js;
    }

    public function view(){
        $styleCSS =  $this->css();
        $javascript = $this->js();
        $page_titre = 'Votre espace Utilisateur';

        $this->render('users.users', compact('page_titre', 'javascript', 'styleCSS'));
    }


}