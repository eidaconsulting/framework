<?php

namespace App\Controller\Users;

use App\Controller\AppController;
use Core\Form\BootstrapForm;

class ForgetactivateController extends AppController {

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

    public function view($id, $token){
        $styleCSS =  $this->css();
        $javascript = $this->js();
        $page_titre = 'Mot de passe oublié';
        $description = 'Formulaire';

        $erreurs = [];

        if(isset($token, $id) && (int)$id > 0){


            $user = $this->User->MyWhere([
                'id' => $id,
                'token' => $token
            ]);

            if($user){

                if(isset($_POST) && array_key_exists('changer', $_POST)){
                    extract($this->secureData($_POST));

                    //Vérification du mot de passe
                    if(mb_strlen($password) < 8){
                        $erreurs[] = "Mot de passe trop court (Au moins 8 caractères)";
                    }

                    //Vérification si les deux mot de passe sont identique
                    if($password !== $password2){
                        $erreurs[] = "Les deux mots de passe ne sont pas identique";
                    }

                    $password = password_hash($password, PASSWORD_DEFAULT);

                    if(count($erreurs) == 0){

                        $this->User->MyUpdate($id, [
                            'password' => $password,
                            'token' => null,
                        ]);

                        $this->alertDefine('Mot de passe changé avec succès', 'success');

                        $redirect = $this->entity()->users('login');
                        $this->redirection($redirect);
                    }

                }

            }
            else {
                $this->alertDefine('Le lien que vous essayez d\'afficher n\'est pas fonctionnel', 'danger');
                $this->notFound();
            }

        }
        else {
            $this->notFound();
        }

        $form = new BootstrapForm($_POST);

        $this->render('users.forgetactivate', compact('form', 'page_titre', 'description',
            'styleCSS', 'javascript'));
    }

}