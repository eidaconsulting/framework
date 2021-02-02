<?php

namespace Modules\Blogs\Admins;


use App\App;
use Core\Captcha\captcha;
use Core\Email\Email;
use Core\Form\BootstrapForm;
use Core\Pagination\Pagination;
use Modules\Blogs\AppController;


class IndexController extends AppController
{

    public function __construct ()
    {
        parent::__construct();
        $this->loadModel('Blogcategorie');
        $this->loadModel('Blog');
        $this->loadModel('Comment');
    }

    public function css ()
    {
        $css = '<link href="' . $this->entity()->css_file("comment.css") . '" rel="stylesheet">';
        return $css;
    }

    public function js ()
    {
        $js = '<script src="' . $this->entity()->js_file("comment.js") . '"></script>';
        return $js;
    }


    public function view ()
    {

        $page_titre = 'Blog megatech';
        $nb_vue = 20;
        $pagination = Pagination::getInstance()->pagination($nb_vue, 'Blog', ['state' => 1]);
        $currentPage = $pagination['currentPage'];
        $nb_page = $pagination['nb_page'];
        $firstOfListe = ($currentPage - 1) * $nb_vue;

        $datas = $this->Blog->MyLim($firstOfListe, $nb_vue, ['state' => 1]);
        $categories = $this->Blogcategorie->MyAll();
        $pageName = 'Blog';
        $pageUrl = '/blogs';

        $form = new BootstrapForm($_POST);

        $this->render('publics.index', compact(
            'page_titre', 'form', 'datas', 'categories', 'pageName', 'currentPage', 'nb_page',
            'pageUrl'));

    }

    public function pages ($id)
    {

        $page_titre = 'Blog d\'entreprise';

        $nb_vue = 20;
        $pagination = Pagination::getInstance()->pagination($nb_vue, 'Blog', ['state' => 1]);
        $currentPage = $id;
        $nb_page = $pagination['nb_page'];
        $firstOfListe = ($currentPage - 1) * $nb_vue;

        $datas = $this->Blog->MyLim($firstOfListe, $nb_vue, ['state' => 1]);
        $categories = $this->Blogcategorie->MyAll();
        $pageName = 'Blog';
        $pageUrl = '/blogs';

        $form = new BootstrapForm($_POST);

        $this->render('publics.index', compact(
            'page_titre', 'form', 'datas', 'categories', 'pageName', 'currentPage', 'nb_page',
            'pageUrl'));

    }

    public function Single ($id, $slug)
    {

        if (isset($id) && (int)$id != 0) {

            if (isset($_POST) && array_key_exists('comment-send', $_POST)) {

                $errors = null;

                if (App::getInstance()->not_empty(['name', 'email', 'comment'])) {

                    $captcha = new captcha();

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

                        $url = $this->entity()->blogs($id . '/' . $slug);
                        $this->redirection($url);

                    } else {
                        $this->alertDefine('Vous n\'avez pas valider le captcha', 'danger');
                    }
                } else {
                    $errors = 'Veuillez remplir tous les champs obligatoire';
                }
            }

            if (isset($_POST) && array_key_exists('comment-response-send', $_POST)) {

                $errors = null;

                if (App::getInstance()->not_empty(['name', 'email', 'comment'])) {

                    $captcha = new captcha();

                    if ($captcha->verif_captcha() == true) {

                        extract($this->secureData($_POST));

                        $user_ip = App::getInstance()->getIpAddress();
                        $this->Comment->MyCreate([
                            'post_id' => $id,
                            'name' => $name,
                            'email' => $email,
                            'comment' => nl2br($comment),
                            'comments_id' => $comments_id,
                            'user_ip' => $user_ip,
                        ]);

                        $post = $this->Blog->MyFind($id);
                        $post_title = $post->title;
                        $post_slug = $post->slug;

                        //Email pour administrateur
                        $objet = 'Nouveau réponse sur ' . $this->entity()->app_info('app_name');

                        $content = '<p>Une nouvelle réponse sur le commentaire suivant : </p>';
                        $content .= '<p>----------------------------------------------------------------</p>';
                        $content .= '<p><em>'. $this->Comment->MyFind($comments_id)->comment .' </em></p>';
                        $content .= '<p>La publication concernée est : <strong><a href="' . $this->entity()->blogs($id.'/'.$post_slug) . '">' . $post_title . '</strong></a></p>';
                        $content .= '<p>Voici la réponse :</p>';
                        $content .= '<p>--------------------------------------------</p>';
                        $content .= '<p><em>' . nl2br($comment) . '</em></p>';
                        $content .= '<p>--------------------------------------------</p>';
                        $content .= '<p><a href="' . $this->entity()->admins('index') . '">Connecter vous à votre espace administration pour éditer le commentaire.</a> </p>';

                        $sendEmail = new Email();
                        $sendEmail->sendEmail($content, $objet, null, $name, $email);

                        //Email pour auteur du commentaire
                        $objet = 'Nouveau réponse à votre commentaire sur ' . $this->entity()->app_info('app_name');

                        $content = '<p>Une nouvelle réponse sur votre commentaire suivant : </p>';
                        $content .= '<p>----------------------------------------------------------------</p>';
                        $content .= '<p><em>'. $this->Comment->MyFind($comments_id)->comment .' </em></p>';
                        $content .= '<p>La publication concernée est : <strong><a href="' . $this->entity()->blogs($id.'/'.$post_slug) . '">' . $post_title . '</strong></a></p>';
                        $content .= '<p>Voici la réponse :</p>';
                        $content .= '<p>--------------------------------------------</p>';
                        $content .= '<p><em>' . nl2br($comment) . '</em></p>';
                        $content .= '<p>--------------------------------------------</p>';
                        $content .= '<p>Rendez-vous sur la publication pour lire la réponse si l\'administrateur l\'a déjà rendu public.</p>';
                        $content .= '<p>Cordialement <br> <strong>MEGATECH</strong></p>';

                        $sendEmail->sendEmail($content, $objet, $users_email);

                        unset($_POST);
                        $this->alertDefine('Votre réponse a été envoyée avec succès. <br>Elle sera soumise à 
                                                l\'approbation de l\'équipe technique', 'success');

                        $url = $this->entity()->blogs($id . '/' . $slug);
                        $this->redirection($url);

                    } else {
                        $this->alertDefine('Vous n\'avez pas valider le captcha', 'danger');
                    }
                } else {
                    $errors = 'Veuillez remplir tous les champs obligatoire';
                }
            }

            $data = $this->Blog->getOnePost($id);

            if ($data != null) {
                $others = $this->Blog->MyOthers(['category_id' => $data->category_id, 'state' => 1], $id, '0,3');
                $categories = $this->Blogcategorie->MyAll();
                $comments = $this->Comment->MyAll(['state' => 1, 'post_id' => $id]);
                $count_comments = count($comments);
                $description = $this->entity()->extrait(250, ' ...', $data->content);
                $page_titre = $data->title;
                $og_picture = $this->entity()->uploads('publication/' . $data->image);

                $comments_by_id = [];
                $datas = [];
                foreach ($comments as $comment){
                    if (is_null($comment->comments_id)) {
                        $comments_by_id[$comment->id] = $comment;
                    }
                }

                foreach ($comments as $k => $comment) {
                    if (!is_null($comment->comments_id)) {
                        $comments_by_id[$comment->comments_id]->children[] = $comment;
                    }
                }


                if ($count_comments > 1) {
                    $nb_comments = '0' . $count_comments . ' commentaires';
                } else {
                    $nb_comments = '0' . $count_comments . ' commentaire';
                }

                $this->Blog->Mysee($id);

                $form = new BootstrapForm($_POST);

                $this->render('publics.blog-single', compact('page_titre', 'description', 'form', 'styleCSS',
                    'javascript', 'data', 'datas', 'categories', 'nb_comments', 'og_picture', 'comments_by_id'));
            } else {
                $this->notFound();
            }
        }
    }
}