<?php

namespace App\Controller\Admins;

use Core\Auth\DBAuth;
use Core\Form\BootstrapForm;
use App\App;

class PasswordController extends \App\Controller\AppController {

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
        $page_titre = 'Changer de mot de passe';

        if(isset($_POST) && array_key_exists('edit', $_POST)) {
            if (App::getInstance()->not_empty(['old_password', 'new_password', 'new_password2'])) {

                extract($this->secureData($_POST));

                if(password_verify ($old_password , $_SESSION['a']['password'])){
                    if($new_password === $new_password2){
                        if(mb_strlen($new_password) >= 8 ){

                            $password = password_hash($new_password, PASSWORD_DEFAULT);

                            $this->Admin->MyUpdate($_SESSION['authA'], [
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

        $form = new BootstrapForm($_POST);
        $this->render('admins.password', compact('form', 'page_titre', 'styleCSS', 'javascript'));
    }

}