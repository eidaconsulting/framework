<?php

namespace App\Controller\Admins;

use App\App;
use \Core\Form\BootstrapForm;

class AdminController extends \App\Controller\AppController {

    public function __construct() {
        parent::__construct();

        $this->loadModel('Admin');
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
        $page_titre = 'Gestion des Utilisateurs';

        $admins = $this->Admin->MyAll([], ('username ASC'));

        $this->render('admins.admins', compact('page_titre', 'styleCSS',
            'javascript', 'admins'));

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

                    $datas = array_splice($_POST, 0, -1);
                    $datas['password'] = password_hash($datas['password'], PASSWORD_DEFAULT);

                    $this->Admin->MyCreate($datas);
                    $this->alertDefine('Adminsitrateur ajouté avec succès', 'success');

                    $url = $this->entity()->admins('admin');
                    $this->redirection($url);
                }
                else {
                    $this->alertDefine('Un administrateur existe déjà avec cet 
                        email ou ce nom d\'utilisateur.', 'danger');
                }

            }
            else {
                $this->alertDefine('Veuillez remplir tous les champs obligatoires', 'danger');
            }
        }

        $page_titre = 'Créer un administrateur';
        $form = new BootstrapForm($_POST);

        $this->render('admins.admins-form', compact('form', 'page_titre', 'javascript', 'styleCSS', 'action'));

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

                        $datas = array_splice($_POST, 0, -1);
                        $datas['password'] = password_hash($datas['password'], PASSWORD_DEFAULT);

                        $this->Admin->MyUpdate($id, $datas);
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

            $this->Admin->MyDelete($id);

            $url = $this->entity()->admins('admin');
            $this->redirection($url);
        }
        else {
            $this->notFound();
        }
    }

}