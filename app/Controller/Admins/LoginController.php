<?php

namespace App\Controller\Admins;

use App\App;
use \Core\Form\BootstrapForm;

class LoginController extends \App\Controller\AppController {

    public function __construct() {
        parent::__construct();

        $this->loadModel('Admin');
    }

    private function css(){
        $css = '<link href="'.$this->entity()->css_file("style-admin.css").'" rel="stylesheet">';
        return $css;
    }

    private function js(){
        $js = '';
        return $js;
    }

    public function view() {
        $styleCSS =  $this->css();
        $javascript = $this->js();
        $erreurs = [];

        $form = new BootstrapForm($_POST);
        $page_titre = 'Espace de connexion Administrateur';

        if(!empty($_POST)){
            extract($this->secureData($_POST));

            if($this->Auth()->loginUser($username, $password, 'a')){
                $this->redirection('/a/index');
            }
            else {
                $erreurs[] = 'Identifiant ou mot de passe incorrect.';
            }
        }

        $this->render('admins.login', compact('form', 'page_titre', 'erreurs', 'styleCSS', 'javascript'));
    }
}