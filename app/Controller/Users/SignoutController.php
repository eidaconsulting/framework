<?php

namespace App\Controller\Users;

use App\Controller\AppController;

class SignoutController extends AppController {

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

        $this->sign_out();

    }

}