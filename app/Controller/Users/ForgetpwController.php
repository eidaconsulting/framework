<?php

namespace App\Controller\Users;

use App\Controller\AppController;
use Core\Email\Email;
use Core\Form\BootstrapForm;
use App\App;

class ForgetpwController extends AppController {

    public function __construct() {
        parent::__construct();
        $this->loadModel('User');
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
        $page_titre = 'Mot de passe oublié';
        $description = 'Formulaire';

        if(isset($_POST) && array_key_exists('recuperer', $_POST)){

            if(App::getInstance()->not_empty(['email'])){

                extract($this->secureData($_POST));

                if(filter_var($email, FILTER_VALIDATE_EMAIL)){

                    $user = $this->User->MyWhere(['email' => $email]);

                    if($user){
                        $token = sha1(time());

                        $this->User->MyUpdate($user->id, [
                            'token' => $token
                        ]);

                        $url = $this->entity()->users('forgetactivate/'. $user->id . '/'. $token);

                        $content = '<p>Vous avez demandé une reinitialisation de votre mot de passe.</p>';
                        $content .= '<p>Pour changer de mot de passe, veuillez cliquer sur le lien suivant.</p>';
                        $content .= '<p><strong><a href="' . $url . '">Reinitialiser mon compte</a></strong></p>';

                        $send_email = new Email();
                        $send_email->sendEmail($content,"Reinitialisation de votre mot de passe", $email);

                        $this->alertDefine('Un email est envoyer sur <strong>' . $email . '</strong> avec 
le procedure pour finaliser l\'initialisation de votre mot de passe.', 'success');

                        $redirect = $this->entity()->users('forgetpw');
                        $this->redirection($redirect);
                    }
                    else {

                        $this->alertDefine('Cet email n\'existe pas dans notre base','danger');
                    }
                }
                else {
                    $this->alertDefine('Veuillez saisir un email valide', 'danger');
                }
            }
            else {
                $this->alertDefine('Veuillez saisir votre adresse email', 'danger');
            }
        }

        $form = new BootstrapForm($_POST);

        $this->render('users.forgetpw', compact('form', 'page_titre', 'description',
            'styleCSS', 'javascript'));
    }

}