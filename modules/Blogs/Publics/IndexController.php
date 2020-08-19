<?php

namespace Modules\Blogs\Publics;


use Core\Captcha\captcha;
use Core\Controller\Controller;
use App\App;
use Core\Email\Email;
use Core\Form\BootstrapForm;
use Core\Pagination\Pagination;
use Modules\Blogs\AppController;


class IndexController extends AppController
{

    public function __construct() {
        parent::__construct();
        $this->loadModel('Blogcategorie');
        $this->loadModel('Blog');
        $this->loadModel('Comment');
    }

    private function css() {
        $css = '<link href="'.$this->entity()->css_file("comment.css").'" rel="stylesheet">';
        return $css;
    }

    private function js() {
        $js = '<script src="'.$this->entity()->js_file("comment.js").'"></script>';
        return $js;
    }


    public function view(){

        $styleCSS = $this->css();
        $javascript = $this->js();

        $page_titre = 'Blog d\'entreprise';
        $nb_vue = 20;
        $pagination = Pagination::getInstance()->pagination($nb_vue, 'Blog');
        $currentPage = $pagination['currentPage'];
        $nb_page = $pagination['nb_page'];
        $firstOfListe = ($currentPage - 1) * $nb_vue;

        $datas = $this->Blog->MyLim($firstOfListe, $nb_vue);
        $categories = $this->Blogcategorie->MyAll();
        $pageName = 'Blog';
        $pageUrl = '/blogs';

        $form = new BootstrapForm($_POST);

        $this->render('publics.index', compact('styleCSS', 'javascript',
            'page_titre', 'form', 'datas', 'categories', 'pageName', 'currentPage', 'nb_page',
            'pageUrl'));

    }

    public function pages($id){

        $page_titre = 'Blog d\'entreprise';
        $styleCSS =  $this->css();
        $javascript = $this->js();

        $nb_vue = 20;
        $pagination = Pagination::getInstance()->pagination($nb_vue, 'Blog');
        $currentPage = $id;
        $nb_page = $pagination['nb_page'];
        $firstOfListe = ($currentPage - 1) * $nb_vue;

        $datas = $this->Blog->MyLim($firstOfListe, $nb_vue);
        $categories = $this->Blogcategorie->MyAll();
        $pageName = 'Blog';
        $pageUrl = '/blogs';

        $form = new BootstrapForm($_POST);

        $this->render('publics.index', compact('styleCSS', 'javascript',
            'page_titre', 'form', 'datas', 'categories', 'pageName', 'currentPage', 'nb_page',
            'pageUrl'));

    }

    public function Single ($id, $slug) {

        $styleCSS = $this->css();
        $javascript = $this->js();

        if(isset($id) && (int)$id != 0){

            if(isset($_POST) && array_key_exists('comment-send', $_POST)){

                $errors = null;

                if(App::getInstance()->not_empty(['name', 'email', 'comment'])) {

                    $captcha =  new captcha();

                    if ($captcha->verif_captcha() == true) {

                        extract($this->secureData($_POST));

                        $user_ip = App::getInstance()->getIpAddress();
                        $this->Comment->MyCreate([
                            'post_id' => $id,
                            'name' => $name,
                            'email' => $email,
                            'comment' => nl2br($comment),
                            'user_ip' => $user_ip,
                        ]);

                        //Email
                        $objet = 'Nouveau commentaire sur ' . $this->entity()->app_info('app_name');

                        $content = '<p>Un nouveau commentaire sur votre publication <strong>' . $this->Blog->MyFind($id)->title . '</strong></p>';
                        $content .= '<p>Voici le commentaire :</p>';
                        $content .= '<p>' . nl2br($comment) . '</p>';
                        $content .= '<p><a href="' . $this->entity()->admins('index') . '">Connecter vous à votre espace administration pour éditer le commentaire.</a> </p>';

                        $sendEmail = new Email();

                        $sendEmail->sendEmail($content, '', $objet, $name, $email);

                        unset($_POST);
                        $this->alertDefine('Votre commentaire a été ajouté avec succès. <br>Il sera soumis à 
                                                l\'approbation de l\'équipe technique', 'success');
                    }else {
                        $this->alertDefine('Vous n\'avez pas valider le captcha', 'danger');
                    }
                }
                else {
                    $errors = 'Veuillez remplir tous les champs obligatoire';
                }
            }

            $data = $this->Blog->MyFind($id);

            if($data != null){
                $datas = $this->Blog->MyOthers(['category_id' => $data->category_id], $id, '0,3');
                $categories = $this->Blogcategorie->MyAll();
                $comments = $this->Comment->MyAll(['state' => 1]);
                $count_comments = count($comments);
                $description = $this->entity()->extrait(250, ' ...', $data->content);
                $page_titre = $data->title;
                $og_picture = $this->entity()->uploads('publication/'.$data->image);

                if($count_comments > 1) {
                    $nb_comments = '0'.$count_comments . ' commentaires';
                }
                else {
                    $nb_comments = '0'.$count_comments . ' commentaire';
                }

                $this->Blog->defUpdateSee($id);

                $form = new BootstrapForm($_POST);

                $this->render('publics.blog-single', compact('page_titre', 'description', 'form', 'styleCSS',
                    'javascript', 'data', 'datas', 'categories', 'comments', 'nb_comments', 'og_picture'));
            }
            else {
                $this->notFound("admin");
            }
        }
    }

}