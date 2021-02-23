<?php

namespace Modules\Blogs\Admins;

use App\App;
use Modules\Blogs\AppController;
use \Core\Form\BootstrapForm;
use Core\Upload\Upload;

class IndexController extends AppController {

    public function __construct() {
        parent::__construct();

        $this->loadModel('Blog');
        $this->loadModel('Blogcategorie');
    }

    public function css(){
        $css = '<link href="' . $this->entity()->css_file("dashboards.css") . '" rel="stylesheet">';
        $css .= '<link href="' . $this->entity()->vendor_file("dataTables/datatables.min.css") . '" rel="stylesheet">';
        $css .= '<link href="'.$this->entity()->vendor_file("summernote/summernote.css").'" rel="stylesheet">';
        $css .= '<link href="'.$this->entity()->vendor_file("summernote/summernote-bs4.css").'" rel="stylesheet">';
        return $css;
    }

    public function js(){
        $js = '<script src="' . $this->entity()->vendor_file("dashboards.js") . '"></script>';
        $js .= '<script src="' . $this->entity()->vendor_file("dataTables/datatables.min.js") . '"></script>';
        $js .= '<script src="' . $this->entity()->js_file("my.datatables.js") . '"></script>';
        $js .= '<script src="'.$this->entity()->vendor_file("summernote/summernote.min.js").'"></script>';
        $js .= '<script src="'.$this->entity()->vendor_file("summernote/summernote-bs4.min.js").'"></script>';
        $js .= '<script src="'.$this->entity()->vendor_file("summernote/summernote-cleaner.js").'"></script>';
        $js .= '<script src="'.$this->entity()->js_file("my.summernote.js").'"></script>';
        return $js;
    }

    /**
     *
     */
    public function View(){

        $this->Auth()->isNotLogin('a');
        $page_titre = 'Gestion de vos publications';

        $datas = $this->Blog->MyAll();

        $this->render('admins.index', compact('page_titre', 'styleCSS',
            'javascript', 'datas'));
    }

    /**
     *
     */
    public function Create() {

        $this->Auth()->isNotLogin('a');
        $action = "Ajouter";
        $page_titre = 'Ajouter une publication';
        $form = new BootstrapForm($_POST);
        $sendPicture = new Upload();

        if(isset($_POST) && array_key_exists('create', $_POST)){

            extract($this->secureData($_POST));
            if(App::getInstance()->not_empty(['title', 'category_id', 'content'])) {

                if($this->Blog->MyInUse(['title' => $title]) < 1){

                    $id = $this->Blog->MyNewId();

                    $image = $sendPicture->savePicture('image', $id, [
                        'autorist_file_type' => 'picture',
                        'file_name' => strtolower($this->entity()->app_info('app_name')).'-blog',
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
                            'slug' => $this->slug($title),
                            'users_id' => $_SESSION['authA']
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

        $categories = $this->Blogcategorie->MyExtract('id', 'category');
        $this->render('admins.index-form', compact('form', 'page_titre',
            'categories', 'action'));
    }

    /**
     * @param $id
     */
    public function Edit($id) {

        $this->Auth()->isNotLogin('a');
        $sendPicture = new Upload();
        $action = "Modifier";
        $page_titre = 'Modifier une publication';

        if(isset($id) && (int)$id !== 0){

            if(isset($_POST) && array_key_exists('create', $_POST)){
                extract($this->secureData($_POST));

                $id = htmlspecialchars($id);

                if(App::getInstance()->not_empty(['title', 'category_id', 'content'])) {

                    if($this->Blog->MyInUse(['title' => $title], $id) < 1){

                        $image = $sendPicture->savePicture('image', $id, [
                            'autorist_file_type' => 'picture',
                            'file_name' => strtolower($this->entity()->app_info('app_name')).'-blog',
                            'directory' => 'publication',
                            'resize' => 'true',
                            'resize_type' => 'center',
                            'resize_w_size' => 500,
                            'resize_h_size' => 250
                        ]);


                        if (is_null($image)) {
                            $image = $this->Blog->MyFind($id)->image;
                        }

                        if(is_array($image)){
                            $this->alertDefine($image, 'danger');
                        }
                        else {

                            //Insertion de l'information de la base de données
                            $this->Blog->MyUpdate($id, [
                                'title' => $title,
                                'category_id' => $category_id,
                                'content' => $content,
                                'image' => $image,
                                'slug' => $this->slug($title)
                            ]);

                            $this->alertDefine('Publication modifiée avec succès', 'success');

                            $url = $this->entity()->blogs('a/index');
                            $this->redirection($url);
                        }
                    }
                    else {
                        $this->alertDefine('Une publication avec ce titre existe déjà', 'danger');
                    }

                }
                else {
                    $this->alertDefine('Veuillez remplir tous les champs obligatoires', 'danger');
                }
            }

            $find = $this->Blog->MyFind($id);
            $form = new BootstrapForm($find);
            $categories = $this->Blogcategorie->MyExtract('id', 'category');

            $this->render('admins.index-form', compact('form', 'page_titre',
                'categories', 'action'));

        }
        else {
            $this->notFound();
        }
    }

    /**
     * @param $id
     */
    public function Delete($id) {

        $this->Auth()->isNotLogin('a');

        if(isset($id) && (int)$id !== 0){

            extract($this->secureData($_POST));

            $this->Blog->MyDelete($id);

            $this->alertDefine('Publication supprimer avec succes');

            $url = $this->entity()->blogs('a/index');
            $this->redirection($url);

        }
        else {
            $this->notFound();
        }

    }

    /**
     * @param $id
     */
    public function activate($id) {

        $this->Auth()->isNotLogin('a');

        if(isset($id) && (int)$id !== 0){

            $data = $this->Blog->MyFind($id);

            if($data->state == 0){
                $this->Blog->MyUpdate($id, ['state' => 1]);
                $this->alertDefine("Article publié avec succès!", "success");
            }
            elseif($data->state == 1){
                $this->Blog->MyUpdate($id, ['state' => 0]);
                $this->alertDefine("Article dépublié avec succès!", "success");
            }

            $url = $this->entity()->blogs('a/index');
            $this->redirection($url);

        }
        else {
            $this->notFound();
        }

    }
}