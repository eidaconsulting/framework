<?php

namespace App\Controller\Users;

use App\Controller\AppController;
use Core\Form\BootstrapForm;
use App\App;

class ProfilController extends AppController {

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
        $page_titre = 'Modifier votre profil';

        if(isset($_POST) && array_key_exists('edit', $_POST)){

            if(App::getInstance()->not_empty(['name', 'email', 'phone'])){

                extract($this->secureData($_POST));

                if(filter_var($email, FILTER_VALIDATE_EMAIL)){

                    if($this->User->MyInUse(['email' => $email], $_SESSION['authU']) == 0){

                        $this->User->MyUpdate($_SESSION['authU'], [
                            'email' => $email
                        ]);

                        $this->Profil->MyUpdate($_SESSION['authU'], [
                            'name' => $name,
                            'phone' => $phone
                        ], 'users_id');

                        $this->alertDefine('Modification effectuée avec succès',
                            'success');

                    }

                }
                else {
                    $this->alertDefine('Veuillez saisir une adresse mail valide');
                }

            }
            else {
                $this->alertDefine('Veuillez remplir tous les champs');
            }
        }

        $users = $this->User->MyJoin('Profil', 'id', 'users_id', true, ['id' => $_SESSION['authU']]);
        $form = new BootstrapForm($users);

        $this->render('users.profil', compact('form', 'page_titre', 'javascript',
            'styleCSS', 'users'));
    }

}