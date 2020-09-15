<?php

namespace Modules\Blogs\Admins;

use App\App;
use Modules\Blogs\AppController;
use \Core\Form\BootstrapForm;

class CategoriesController extends AppController {

    public function __construct() {
        parent::__construct();
        $this->loadModel('Blogcategorie');
        $this->loadModel('Blog');
    }

    public function stylecss(){
        $stylecss = '<link href="'.$this->entity()->vendor_file("dataTables/datatables.min.css").'" rel="stylesheet">';
        return $stylecss;
    }

    public function javascript(){
        $javascript = '<script src="'.$this->entity()->vendor_file("dataTables/datatables.min.js").'"></script>';
        $javascript .= '<script> 
                            $(function() {
                                $(\'#datatable\').DataTable({
                                    responsive: true
                                });
                            });
                        </script>';
        return $javascript;
    }

    public function View() {
        $this->Auth()->isNotLogin('a');

        $styleCSS =  $this->stylecss();
        $javascript = $this->javascript();

        $datas = $this->Blogcategorie->MyAll([], 'category ASC');
        $page_titre = 'Categories';

        $this->render('admins.categories', compact('page_titre', 'styleCSS',
            'javascript', 'datas'));
    }

    public function Create() {
        $this->Auth()->isNotLogin('a');

        if(isset($_POST) && array_key_exists('create', $_POST)){

            extract($this->secureData($_POST));

            if(App::getInstance()->not_empty(['category'])) {

                if($this->Blogcategorie->MyInUse(['category' => $category]) < 1){

                    $this->Blogcategorie->MyCreate([
                        'category' => ucfirst($category),
                        'slug' => $this->slug($category)
                    ]);
                    $this->alertDefine('Categorie ajoutée avec succès', 'success');

                    $url = $this->entity()->blogs('a/categories');
                    $this->redirection($url);
                }
                else {
                    $this->alertDefine('Cette catégorie existe déjà.', 'danger');
                }

            }
            else {
                $this->alertDefine('Veuillez remplir tous les champs obligatoires', 'danger');
            }
        }

        $page_titre = 'Ajouter une ligne';
        $action = 'Ajouter';

        $form = new BootstrapForm($_POST);

        $this->render('admins.categories-form', compact('form', 'page_titre', 'styleCSS', 'action'));

    }

    public function Edit($id) {
        $this->Auth()->isNotLogin('a');

        if(isset($id) && (int)$id !== 0){

            if(isset($_POST) && array_key_exists('create', $_POST)){

                extract($this->secureData($_POST));

                $id = htmlspecialchars($id);

                if(App::getInstance()->not_empty(['category'])) {

                    if($this->Blogcategorie->MyInUse(['category' => $category], $id) < 1){

                        //Insertion de l'information de la base de données
                        $this->Blogcategorie->MyUpdate($id, [
                            'category' => ucfirst($category),
                            'slug' => $this->slug($category)
                        ]);
                        $this->alertDefine('Ligne modifiée avec succès', 'success');

                        $url = $this->entity()->blogs('a/categories');
                        $this->redirection($url);
                    }
                    else {
                        $this->alertDefine('Cette catégorie existe déjà', 'danger');
                    }

                }
                else {
                    $this->alertDefine('Veuillez remplir tous les champs obligatoires', 'danger');
                }
            }

            $page_titre = 'Modifier une catégorie';
            $action = 'Modifier';

            $find = $this->Blogcategorie->MyFind($id);
            $form = new BootstrapForm($find);

            $this->render('admins.categories-form', compact('form', 'page_titre', 'javascript', 'styleCSS', 'action'));


        }
        else {
            $this->notFound();
        }
    }

    public function Delete($id) {
        $this->Auth()->isNotLogin('a');

        if(isset($id) && (int)$id !== 0){

            $this->Blogcategorie->MyDelete($id);
            $this->Blog->MyUpdate($id, ['category_id' => 1], 'category_id');

            $this->alertDefine('Catégorie supprimée avec succes');

            $url = $this->entity()->blogs('a/categories');
            $this->redirection($url);

        }
        else {
            $this->notFound();
        }

    }

}