<?php

namespace Modules\Paiements;



use App\App;
use \Core\Auth\DBAuth;
use Core\Controller\Controller;
use Core\Entity\Entity;


class AppController extends Controller {

    protected $template = 'default';

    public function __construct() {
        $this->viewPath = ROOT . '/modules/Paiements/Views/';
    }

    protected function loadModel($modal_name){
        $this->$modal_name = App::getInstance()->getTable($modal_name);
    }

    public function Auth(){
        $auth = new DBAuth(App::getInstance()->getDb());
        return $auth;
    }

    public function entity() {
        $entity = new Entity();
        return $entity;
    }

}