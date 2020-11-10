<?php

namespace Modules\Blogs;



use App\App;
use \Core\Auth\DBAuth;
use Core\Entity\Entity;
use Globals\GlobalController;


class AppController extends GlobalController {

    protected $template = 'default';

    public function __construct() {
        $this->viewPath = ROOT . '/modules/Blogs/Views/';
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