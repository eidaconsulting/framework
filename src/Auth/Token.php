<?php

namespace core\Auth;

class Token
{
    private $token;

    public function __construct ($type) {
        if(isset($_SESSION[$type]) && !is_null($_SESSION[$type.'_token'])){
            $this->token = $_SESSION[$type.'_token'];
        }
    }

    public function csrf(){
        return '<input type="hidden" name="token_csrf" value="'.$this->token.'" required="required">';
    }

    public function checkCSRF($_POST){
        if(!array_key_exists('token_csrf', $_POST)){
            return false;
        }
        elseif($_POST['token_csrf'] != $this->token){
            return false;
        }
        return true;
    }
}
