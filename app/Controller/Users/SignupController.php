<?php

namespace App\Controller\Users;

use App\Controller\AppController;
use Core\Form\BootstrapForm;
use App\App;
use Core\Email\Email;

class SignupController extends AppController {

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
        $erreurs = [];
        $success = [];
        $url = null;

        if(!empty($_POST) && array_key_exists('inscription', $_POST)){

           if(App::getInstance()->not_empty(['name', 'email', 'phone', 'password', 'password2'])){

               extract($this->secureData($_POST));

               if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                   $erreurs[] = "Veuillez saisir un email valide!";
               }

               if(mb_strlen($password) < 8){
                   $erreurs[] = "Mot de passe trop court (Au moins 8 caractères)";
               }

               if($password !== $password2){
                   $erreurs[] = "Les deux mots de passe ne sont pas identique";
               }

               if($this->User->MyInUse(['email' => $email]) > 0){
                   $erreurs[] = "Cet email est déja utilisé";
               }

               $email = strtolower($email);
               $password = password_hash($password, PASSWORD_DEFAULT);
               $uniqid = uniqid();
               $token = md5(time());

               if(count($erreurs) == 0){

                    $this->User->MyCreate([
                       'email' => $email,
                       'password' => $password,
                       'uniqid' => $uniqid,
                       'token' => $token
                   ]);

                   $insert_id = $this->User->MyNewId(0);

                   $this->Profil->MyCreate([
                       'users_id' => $insert_id,
                       'name' => $name,
                       'phone' => $phone,
                   ]);

                   $url = $this->entity()->users('activate/'.$uniqid.'/'.$token);

                   $content = '<h4>Bienvenue</h4>
                    <p>Votre ouverture de compte sur 
                    <strong>' . App::getInstance()->app_info('app_name') . '</strong>
                    s\'est bien déroulée. Pour acceder à votre compte, complèter votre profil et être prêt à
                    trouver des partenaires, veuillez bien activer votre compte en cliquant sur le lien suivant :</p>
                    <p><strong><a href="' . $url . '" target="new">Activer mon compte</a></strong></p>';

                   $objet = 'Votre compte '. App::getInstance()->app_info('app_name');
                   $to = $email;

                   $emailClass = new Email();

                   if($emailClass->sendEmail($content, $to, $objet, null, null)){

                       //Construction email de l'administrateur
                       $content = '<h4>Bonjour Admin</h4>';
                       $content .= '<p>Une nouvelle inscription vient d\'être fait sur votre plateforme.</p>';
                       $content .= '<p>Voici les informations fournies par l\'utilisateur :</p>';
                       $content .= '<p>-----------------------------------</p>';
                       $content .= '<p><strong>Nom : </strong>' . $name .'<br>';
                       $content .= '<p><strong>Email : </strong>' . $email .'<br>';
                       $content .= '<p><strong>Téléphone : </strong>' . $phone .'<br>';
                       $content .= '<p><strong>Date d\'inscription : </strong>' . date('d/m/Y h:i:s') .'</p>';
                       $content .= '<p>-----------------------------------</p>';

                       $emailClass->sendEmail($content, null, $new_objet, null, null);

                       $this->alertDefine('Création de boutique prise en compte. Veuillez consulter 
<strong>' . $email . '</strong> afin de confirmer votre compte pour complèter votre profil', 'success') ;

                       $this->redirection(App::getInstance()->app_info('app_url'));

                   };
               }
           }
        }

        $this->Auth()->isLogin('Users');
        $page_titre = 'Créer un compte utilisateur';
        $form = new BootstrapForm($_POST);

        $this->render('users.signup', compact('form', 'page_titre', 'erreurs', 'styleCSS', 'success',
            'javascript', 'url'));
    }

}