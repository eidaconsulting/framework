<?php

namespace App\Controller;

use Core\Controller\Controller;
use App\App;
use \Core\Auth\DBAuth;
use Globals\GlobalEntity;

class AppController extends Controller {

    protected $template = 'default';

    public function __construct(string $type = 'default') {
        if($type === 'blog'){
            $this->viewPath = ROOT . '/modules/Blogs/Views/';
        }
        else {
            $this->viewPath = ROOT . '/app/Views/';
        }
    }

    protected function loadModel($modal_name){
        $this->$modal_name = App::getInstance()->getTable($modal_name);
    }

    public function Auth(){
        $auth = new DBAuth(App::getInstance()->getDb());
        return $auth;
    }

    public function entity() {
        $entity = new GlobalEntity();
        return $entity;
    }

}