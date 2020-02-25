<?php

namespace Modules\Blogs\Admins;

use App\App;
use Modules\Blogs\AppController;
use \Core\Form\BootstrapForm;
use Core\Upload\Upload;

class CommentsController extends AppController {

    public function __construct() {
        parent::__construct();

        $this->loadModel('Blog');
        $this->loadModel('Blogcategorie');
        $this->loadModel('Comment');
    }

    public function css(){
        $css = '<link href="'.$this->entity()->vendor_file("dataTables/datatables.min.css").'" rel="stylesheet">';
        return $css;
    }

    public function js(){
        $js = '<script src="'.$this->entity()->vendor_file("dataTables/datatables.min.js").'"></script>';
        $js .= '<script> 
                            $(function() {
                                $(\'#datatable\').DataTable({
                                    responsive: true
                                });
                            });
                        </script>';
        return $js;
    }

    public function View(){

        $this->Auth()->isNotLogin('a');
        $styleCSS =  $this->css();
        $javascript = $this->js();


        $page_titre = 'Toutes les commentaires';

        $datas = $this->Comment->MyAll();

        $this->render('admins.comments', compact('page_titre', 'styleCSS',
            'javascript', 'categories', 'datas'));

    }

    public function Create() {

        $this->Auth()->isNotLogin('a');
        $sendPicture = new Upload();

        if(isset($_POST) && array_key_exists('create', $_POST)){

            extract($this->secureData($_POST));

            if(App::getInstance()->not_empty(['title', 'category_id', 'content'])) {

                if($this->Blog->MyInUse(['title' => $title]) < 1){

                    $id = $this->Blog->MyNewId();

                    $image = $sendPicture->savePicture('image', $id, [
                        'autorist_file_type' => 'picture',
                        'file_name' => 'afrilocation-blog',
                        'directory' => 'publication',
                        'resize' => 'true',
                        'resize_type' => 'center',
                        'resize_w_size' => 500,
                        'resize_h_size' => 250
                    ]);


                    if (is_null($image)) {
                        $this->alertDefine('Veuillez charger une image', 'danger');
                    }
                    elseif(is_array($image)){
                        $this->alertDefine($image, 'danger');
                    }
                    else {
                        //Insertion de l'information de la base de données
                        $this->Blog->MyCreate([
                            'title' => $title,
                            'category_id' => $category_id,
                            'content' => $content,
                            'image' => $image,
                            'slug' => $this->slug($title)
                        ]);
                        $this->alertDefine('Ligne ajoutée avec succès', 'success');

                        $url = $this->entity()->blogs('a/index');
                        $this->redirection($url);

                    }
                }
                else {
                    $this->alertDefine('Ce titre existe déjà.', 'danger');
                }

            }
            else {
                $this->alertDefine('Veuillez remplir tous les champs obligatoires', 'danger');
            }
        }
        else {
            $page_titre = 'Ajouter une publication';

            $form = new BootstrapForm($_POST);

            $categories = $this->Blogcategorie->MyExtract('id', 'category');

            $this->render('admins.index-create', compact('form', 'page_titre', 'styleCSS', 'javascript', 'categories'));
        }

    }

    public function Published($id) {

        $this->Auth()->isNotLogin('a');
        if(isset($id) && (int)$id !== 0){

            extract($this->secureData($_POST));

            $id = htmlspecialchars($id);

            $this->Comment->MyUpdate($id, [
                'state' => 1,
            ]);

            $this->alertDefine('Commentaire publié', 'success');

            $url = $this->entity()->blogs('a/comments');
            $this->redirection($url);

        }
        else {
            $this->notFound();
        }
    }

    public function Depublished($id) {

        $this->Auth()->isNotLogin('a');
        if(isset($id) && (int)$id !== 0){

            extract($this->secureData($_POST));

            $id = htmlspecialchars($id);

            $this->Comment->MyUpdate($id, [
                'state' => 2,
            ]);

            $this->alertDefine('Commentaire publié', 'success');

            $url = $this->entity()->blogs('a/comments');
            $this->redirection($url);

        }
        else {
            $this->notFound();
        }
    }

    public function Delete($id) {

        $this->Auth()->isNotLogin('a');
        if(isset($id) && (int)$id !== 0){

            extract($this->secureData($_POST));

            $this->Comment->MyDelete($id);

            $this->alertDefine('Commentaire supprimé avec succes', 'success');

            $url = $this->entity()->blogs('a/comments');
            $this->redirection($url);

        }
        else {
            $this->notFound();
        }


    }
}