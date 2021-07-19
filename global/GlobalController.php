<?php


namespace Globals;


use Core\Controller\Controller;
use Core\i18n\i18n;

class GlobalController extends Controller
{

    protected function lang(){
        return new i18n();
    }

}