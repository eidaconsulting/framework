<?php

namespace App\Controller\Admins;

use Core\Auth\DBAuth;
use Core\Form\BootstrapForm;
use App\App;

class SignoutController extends \App\Controller\AppController {

    public function __construct() {
        parent::__construct();

        $this->loadModel('Admin');
    }

    public function view(){
        $this->sign_out('a');
    }

}