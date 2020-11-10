<?php

namespace App\Controller\Admins;


class SignoutController extends \App\Controller\AppController {

    public function __construct() {
        parent::__construct();

        $this->loadModel('Admin');
    }

    public function view(){
        $this->sign_out('a');
    }

}