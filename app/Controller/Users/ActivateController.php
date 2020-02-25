<?php

    namespace App\Controller\Users;

    use App\Controller\AppController;
    use Core\Form\BootstrapForm;

    class ActivateController extends AppController
    {

        public function __construct()
        {
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

        public function view($uniqid, $token) {

            $styleCSS =  $this->css();
            $javascript = $this->js();

            if (isset($uniqid, $token) && !is_null($uniqid) && !is_null($token)) {
                $uniqid = $uniqid;
                $token = $token;

                $select_info = $this->User->MyWhere(['uniqid' => $uniqid]);

                if (count($select_info) > 0) {

                    if ($token === $select_info->token) {

                        $this->User->MyUpdate($select_info->id, [
                            'state' => 1,
                            'token' => null,
                        ]);

                        $_SESSION['authU'] = $select_info->id;
                        $this->Auth()->getConnectInfos($select_info->id, 'u');

                        $url = $this->entity()->users('index');
                        $this->redirection($url);
                    }
                    else {
                        $this->alertDefine('Ce lien d\'activation à expirer. Veuillez le vérifier et 
                        réessayer', 'danger');

                        $url = $this->entity()->users('login');;
                        $this->redirection($url);
                    }
                }
                else {
                    $this->alertDefine('Ce lien d\'activation à expirer. Veuillez le vérifier et 
                réessayer', 'danger');

                    $url = $this->entity()->users('login');;
                    $this->redirection($url);
                }

            }
            else {
                $this->notFound();
            }

            $page_titre = 'Activation de votre compte';

            $form = new BootstrapForm($_POST);
            $this->render('users.login', compact('form', 'page_titre', 'javascript', 'styleCSS'));
        }

    }