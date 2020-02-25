<?php

namespace App\Controller\Users;

use App\Controller\AppController;
use Core\Form\BootstrapForm;
use App\App;

class PasswordController extends AppController {

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

        if(isset($_POST) && array_key_exists('edit', $_POST)) {

            if (App::getInstance()->not_empty(['old_password', 'new_password', 'new_password2'])) {

                extract($this->secureData($_POST));

                if(password_verify ($old_password , $_SESSION['user']['password'])) {

                    if($new_password === $new_password2) {

                        if(mb_strlen($new_password) >=8 ) {

                            $password = password_hash($new_password, PASSWORD_DEFAULT);

                            $this->User->Update($_SESSION['authU'], [
                                'password' => $password
                            ]);

                            $this->alertDefine('Mot de passe changé avec succès','success');
                        }
                        else {
                            $this->alertDefine('Le nouveau de passe doit comporter au moins 8 caractères');
                        }
                    }
                    else {
                        $this->alertDefine('Les deux nouveaux mots de passe ne correspondent pas');
                    }
                }
                else {
                    $this->alertDefine('L\'ancien mot de passe n\'est pas correct');
                }

            }
            else {
                $this->alertDefine('Veuillez remplir tous les champs');
            }
        }

        $page_titre = 'Changer de mot de passe';
        $form = new BootstrapForm($_POST);

        $this->render('users.password', compact('form', 'page_titre', 'styleCSS', 'javascript'));
    }

}