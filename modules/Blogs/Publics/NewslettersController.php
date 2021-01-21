<?php

namespace Modules\Blogs\Publics;

use App\App;
use Modules\Blogs\AppController;


class NewslettersController extends AppController
{

    public function __construct() {
        parent::__construct();
        $this->loadModel('Blognewsletter');
    }

    protected function css() {
        $css = '';
        return $css;
    }

    protected function js() {
        $js = '';
        return $js;
    }


    public function view(){
        $styleCSS = $this->css();
        $javascript = $this->js();

        if(isset($_POST) && array_key_exists('newsletters', $_POST)){

            extract($this->secureData($_POST));
            $backUrl = $_SERVER['HTTP_REFERER'];
            $addressIp = $this->entity()->getIpAddress();

            if(App::getInstance()->not_empty(["newsletterEmail"])){

                if($this->Blognewsletter->MyInUse(['email' => $newsletterEmail]) < 1){

                    $this->Blognewsletter->MyCreate([
                        'email' => $newsletterEmail,
                        'ip' => $addressIp,
                    ]);

                    $this->alertDefine('Votre email a été ajouté à notre base d\'abonnés.', 'success');
                }
                else {
                    $this->alertDefine('Cet email existe déjà dans notre base de données. Veuillez en saisir un autre', 'danger');
                }

            }
            else {
                $this->alertDefine('Veuillez saisir une adresse Email', 'danger');
            }

            $this->redirection($backUrl);

        }
        else {
            $redirect = $this->entity()->blogs('');
            $this->redirection($redirect);
        }

    }

}