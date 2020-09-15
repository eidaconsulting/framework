<?php

namespace App\Controller\Users;

use App\Controller\AppController;
use Core\Form\BootstrapForm;

class LoginController extends AppController {

    public function __construct() {
        parent::__construct();

        $this->loadModel('User');
        $this->loadModel('Profil');
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
        $styleCSS =  $this->css();
        $javascript = $this->js();
        $erreurs = [];

        if(!empty($_POST)){
            extract($this->secureData($_POST));

            if(!$this->Auth()->loginUser($username, $password)){
                $erreurs[] = 'Identifiant et mot de passe incorrect';
            }
            else {
                $url = $this->entity()->users('index');
                $this->redirection($url);
            }
        }

        $page_titre = 'Espace de connexion Utilisateurs';

        $form = new BootstrapForm($_POST);
        $this->render('users.login', compact('form', 'page_titre', 'styleCSS', 'javascript', 'erreurs'));
    }

}