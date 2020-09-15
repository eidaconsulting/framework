<?php

namespace App\Controller\Publics;

use Core\Controller\Controller;
use App\App;
use Core\Database\dbCreate;
use Core\Database\MysqlDatabase;
use Core\Form\BootstrapForm;
use Core\Table\Table;

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