<?php

namespace App\Controller\Publics;

use Core\Captcha\captcha;
use Core\Controller\Controller;
use App\App;
use Core\Email\Email;
use Core\Form\BootstrapForm;

class ContactsController extends \App\Controller\AppController {

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
        $form = new BootstrapForm();

        if(isset($_POST) && array_key_exists('envoyer', $_POST)){

            if(App::getInstance()->not_empty(['name', 'email', 'phone', 'objet', 'message'])){

                $captcha = new captcha();

                if ($captcha->verif_captcha() == true) {

                    extract($this->secureData($_POST));
                    $content = $message;
                    $content .= '<br><br>---------------------------------<br>';
                    $content .= 'Envoyer par : ' . $name;
                    $content .= '<br>Email : ' . $email;
                    $content .= '<br>Phone : ' . $phone;
                    $content .= '<br><br><br>---------------------------------<br>';
                    $content .= '<p>Ce email a été envoyé depuis le fomulaire de contact du site http://usl-benin.com</p>';

                    $sendEmail = new Email();
                    $sendEmail->sendEmail($content, null, $objet, $name, $email);

                    $this->alertDefine('Email envoyé avec succès', 'success');

                    unset($_POST);
                }
                else {
                    $this->alertDefine('Vous n\'avez pas valider le captcha', 'danger');
                }


            }
            else {
                $this->alertDefine('Veuillez remplir tous les champs', 'danger');
            }

            $form = new BootstrapForm($_POST);
        }
        $page_titre ="";
        $description = "";
        $og_picture = "";

        $this->render('publics.contacts', compact('styleCSS', 'javascript',
            'page_titre', 'form', 'description', 'og_picture'));
    }

}