<?php

namespace App\Controller\Publics;

use Core\Database\dbCreate;

class DatabasesController extends \App\Controller\AppController {

    public function __construct() {
        parent::__construct();
        //$this->loadModel('Product');
    }

    public function view(){

        $file = new dbCreate();

        $file->execute();

        //$this->redirection($this->entity()->url());
    }

}