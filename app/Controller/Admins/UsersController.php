<?php

namespace App\Controller\Admins;

use App\App;
use \Core\Form\BootstrapForm;

class UsersController extends \App\Controller\AppController {

    public function __construct() {
        parent::__construct();

        $this->loadModel('User');
        $this->loadModel('Profil');
    }

    protected function css(){
        $css = '<link href="'.$this->entity()->css_file("style-admin.css").'" rel="stylesheet">';
        $css .= '<link href="'.$this->entity()->vendor_file("dataTables/datatables.min.css").'" rel="stylesheet">';
        return $css;
    }

    protected function js(){
        $js = '<script src="'.$this->entity()->vendor_file("dataTables/datatables.min.js").'"></script>';
        $js .= '<script src="'.$this->entity()->js_file("my.datatables.js").'"></script>';
        return $js;
    }

    public function view(){
        $styleCSS =  $this->css();
        $javascript = $this->js();
        $page_titre = 'Liste des utilisateurs de la plateforme';

        $datas = $this->User->MyJoin('Profil', 'id', 'users_id', false, ['state' => 1]);

        $this->render('admins.users', compact('page_titre', 'styleCSS',
            'javascript', 'datas', 'form'));

    }

    public function create(){
        $styleCSS =  $this->css();
        $javascript = $this->js();
        $action = "Ajouter";

        if(isset($_POST) && array_key_exists('create', $_POST)){
            extract($this->secureData($_POST));

            if(App::getInstance()->not_empty(['username', 'password', 'email', 'name',
                'phone', 'userright'])) {

                if($this->Admin->MyInUse(['username' => $username]) < 1
                    || $this->Admin->MyInUse(['email' => $email]) < 1){

                    //Insertion de l'information de la base de données
                    $this->Admin->MyCreate([
                        'username' => $username,
                        'password' => password_hash($password, PASSWORD_DEFAULT),
                        'email' => $email,
                        'name' => $name,
                        'phone' => $phone,
                        'userright' => $userright
                    ]);
                    $this->alertDefine('Utilisateur ajouté avec succès','success');

                    $url = $this->entity()->admins('admin');
                    $this->redirection($url);
                }
                else {
                    $this->alertDefine('Un utilisateur existe déjà avec cet 
                    email ce nom d\'utilisateur.', 'danger');
                }

            }
            else {
                $this->alertDefine('Veuillez remplir tous les champs obligatoires', 'danger');
            }
        }

        $page_titre = 'Créer un utilisateur';
        $form = new BootstrapForm($_POST);

        $this->render('admins.users-form', compact('form', 'page_titre', 'javascript', 'styleCSS', 'action'));

    }

    public function edit($id) {

        if(isset($id) && (int)$id !== 0){

            $styleCSS =  $this->css();
            $javascript = $this->js();
            $action = "Modifier";

            if(isset($_POST) && array_key_exists('create', $_POST)){
                extract($this->secureData($_POST));

                $id = htmlspecialchars($id);

                if(App::getInstance()->not_empty(['username', 'password', 'email', 'name', 'phone', 'userright'])) {

                    if($this->Admin->MyInUse(['username' => $username], $id) < 1
                        || $this->Admin->MyInUse(['email' => $email], $id) < 1){

                        $this->Admin->MyUpdate($id, [
                            'username' => $username,
                            'password' => password_hash($password, PASSWORD_DEFAULT),
                            'email' => $email,
                            'name' => $name,
                            'phone' => $phone,
                            'userright' => $userright
                        ]);
                        $this->alertDefine('Adminsitrateur modifié avec succès', 'success');

                        $url = $this->entity()->admins('admin');
                        $this->redirection($url);
                    }
                    else {
                        $this->alertDefine('Un administrateur existe déjà avec 
                            cet email ou ce nom d\'utilisateur.', 'danger');
                    }

                }
                else {
                    $this->alertDefine('Veuillez remplir tous les champs 
                        obligatoires', 'danger');
                }
            }

            $page_titre = 'Modifier un administrateur';
            $find = $this->Admin->MyFind($id);
            $form = new BootstrapForm($find);

            $this->render('admins.admins-form', compact('form', 'page_titre',
                'javascript', 'styleCSS', 'action'));
        }
        else {
            $this->notFound();
        }

    }

    public function delete($id) {

        if(isset($id) && (int)$id !== 0){

            $this->User->MyDelete($id);
            $this->Profil->MyDelete($id, 'users_id');

            $url = $this->entity()->admins('users');
            $this->redirection($url);
        }
        else {
            $this->notFound();
        }
    }

/*
    public function views(){
        $styleCSS =  $this->css();
        $javascript = $this->js();


        if(isset($_GET['action']) && $_GET['action'] === 'edit'){

            if(isset($_GET['id']) && (int)$_GET['id'] !== 0){
                extract($this->secureData($_POST));

                $id = htmlspecialchars($_GET['id']);

                $users = $this->User->MyFind($id);

                if($users){
                    if($users->state == 1){

                        $this->User->MyUpdate($id, [
                            'state' => 0,
                        ]);

                        $this->alertDefine('Compte désactivée', 'success');
                        $content = '<h4>Désolé</h4>';
                        $content .= '<p>Votre compte sur <strong>' . App::getInstance()->app_info("app_name") . '</strong>';
                        $content .= 'a été desactivé par l\'administrateur du site. 
                                        Pour connaitre les raisons de cette action veuillez 
                                        contacter l\'administrateur à travers le formulaire 
                                        de contact présent sur le site MDE.</p>';

                        $objet = 'Désactivation de votre compte';

                    }
                    else {
                        $this->User->MyUpdate($id, [
                            'state' => 1,
                        ]);
                        $this->alertDefine('Compte Activée', 'success');

                        $content = '<h4>Désolé</h4>';
                        $content .= '<p>Votre compte sur <strong>' . App::getInstance()->app_info("app_name") . '</strong>';
                        $content .= 'a été desactivé par l\'administrateur du site. 
                                        Vous pouvez à présent vous connecter pour 
                                        configurer votre boutique et commencer par vendre.</p>';

                        $objet = 'Désactivation de votre compte';
                    }

                    $to = $users->state;

                    $emailClass = new Email();
                    $emailClass->sendEmail($content, $to, $objet, null, null);
                }
                else {
                    $this->notFound();
                }

                $url = App::getInstance()->app_info("app_url") . '/admins/users';
                $this->redirection($url);
            }
            else {
                $this->notFound();
            }

        }


    }

*/
}