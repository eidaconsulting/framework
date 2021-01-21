<?php

namespace App\Controller\Users;

use App\Controller\AppController;

class SignoutController extends AppController {

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

        $this->sign_out();

    }

}