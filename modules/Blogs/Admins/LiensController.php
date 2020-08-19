<?php

namespace Modules\Blogs\Admins;

use App\App;
use Modules\Blogs\AppController;
use \Core\Form\BootstrapForm;
use Core\Upload\Upload;

class LiensController extends AppController {

    public function __construct() {
        parent::__construct();

        $this->loadModel('Blog');
        $this->loadModel('Blogcategorie');
    }

    public function css(){
        $css = '<link href="'.$this->entity()->vendor_file("dataTables/datatables.min.css").'" rel="stylesheet">';
        $css .= '<link href="'.$this->entity()->vendor_file("summernote/summernote.css").'" rel="stylesheet">';
        $css .= '<link href="'.$this->entity()->vendor_file("summernote/summernote-bs4.css").'" rel="stylesheet">';
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
        $js .= '<script src="'.$this->entity()->vendor_file("summernote/summernote.min.js").'"></script>';
        $js .= '<script src="'.$this->entity()->vendor_file("summernote/summernote-bs4.min.js").'"></script>';
        $js .= '<script src="'.$this->entity()->js_file("my.summernote.js").'"></script>';
        return $js;
    }

    public function View(){

        $this->Auth()->isNotLogin('a');
        $styleCSS =  $this->css();
        $javascript = $this->js();
        $page_titre = 'Gestion de vos publications';
        $form = new BootstrapForm($_POST);
        $categories = $this->Blogcategorie->MyExtract('id', 'category');
        //$datas = $this->Blog->MyAll();

        if(isset($_POST) && array_key_exists('check', $_POST)){

            extract($this->secureData($_POST));

            /**
             * Curl send get request, support HTTPS protocol
             * @param string $url The request url
             * @param string $refer The request refer
             * @param int $timeout The timeout seconds
             * @return mixed
             */
            function getRequest($url, $refer = "", $timeout = 10)
            {
                $ssl = stripos($url,'https://') === 0 ? true : false;
                $curlObj = curl_init();
                $options = [
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_FOLLOWLOCATION => 1,
                    CURLOPT_AUTOREFERER => 1,
                    CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)',
                    CURLOPT_TIMEOUT => $timeout,
                    CURLOPT_HEADER => FALSE,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_0,
                    CURLOPT_HTTPHEADER => ['Expect:'],
                    CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
                ];
                if ($refer) {
                    $options[CURLOPT_REFERER] = $refer;
                }
                if ($ssl) {
                    //support https
                    $options[CURLOPT_SSL_VERIFYHOST] = false;
                    $options[CURLOPT_SSL_VERIFYPEER] = false;
                }
                curl_setopt_array($curlObj, $options);
                $returnData = curl_exec($curlObj);
                if (curl_errno($curlObj)) {
                    //error message
                    $returnData = curl_error($curlObj);
                }
                curl_close($curlObj);
                return $returnData;
            }

            /**
             * Curl send post request, support HTTPS protocol
             * @param string $url The request url
             * @param array $data The post data
             * @param string $refer The request refer
             * @param int $timeout The timeout seconds
             * @param array $header The other request header
             * @return mixed
             */
            function postRequest($url, $data, $refer = "", $timeout = 10, $header = [])
            {
                $curlObj = curl_init();
                $ssl = stripos($url,'https://') === 0 ? true : false;
                $options = [
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_POST => 1,
                    CURLOPT_POSTFIELDS => $data,
                    CURLOPT_FOLLOWLOCATION => 1,
                    CURLOPT_AUTOREFERER => 1,
                    CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)',
                    CURLOPT_TIMEOUT => $timeout,
                    CURLOPT_HEADER => FALSE,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_0,
                    CURLOPT_HTTPHEADER => ['Expect:'],
                    CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
                    CURLOPT_REFERER => $refer
                ];
                if (!empty($header)) {
                    $options[CURLOPT_HTTPHEADER] = $header;
                }
                if ($refer) {
                    $options[CURLOPT_REFERER] = $refer;
                }
                if ($ssl) {
                    //support https
                    $options[CURLOPT_SSL_VERIFYHOST] = false;
                    $options[CURLOPT_SSL_VERIFYPEER] = false;
                }
                curl_setopt_array($curlObj, $options);
                $returnData = curl_exec($curlObj);
                if (curl_errno($curlObj)) {
                    //error message
                    $returnData = curl_error($curlObj);
                }
                curl_close($curlObj);
                return $returnData;
            }


            $getRes = getRequest($liens);
            //echo $getRes;//Get index page html of php.net

            //$getRes = postRequest($liens,[]);
            //echo $postRes;

            /*$getRes = str_replace('  ', '', $getRes);
            $getRes = str_replace("\n", '', $getRes);
            $getRes = str_replace("\r", '', $getRes);
            $getRes = str_replace("\t", '', $getRes);

            $getRes = preg_replace('/<body(.*?)>/', '', $getRes);*/

            $page = new \DOMDocument('1.0', 'UTF-8');
            $internalErrors = libxml_use_internal_errors(true);
            $page->loadHTML($getRes);
            libxml_use_internal_errors($internalErrors);
            $paragraphe = [];
            $lesparagraphe = $page->getElementsByTagName('p');
            $lesimages = $page->getElementsByTagName('img');
            $title = $page->getElementsByTagName("title")[0]->nodeValue;


            for ($i = 0; $i < $lesparagraphe->length; $i++) {
                array_push($paragraphe, '<p>' . $lesparagraphe->item($i)->nodeValue . '</p>');
            }

            //AJOUT DE LA SOURCE
            $source = '<hr>';
            $source .= 'Source : <a href="'.$liens.'">'.$liens.'</a>';
            array_push($paragraphe, '<p>' . $source . '</p>');

            $paragraphy = implode($paragraphe);

            $data = array(
                'category_id'=> $category_id,
                'content'=> $paragraphy,
                'liens'=>$liens,
                'title'=>$title,
            );

            $form = new BootstrapForm($data);

        }


        if(isset($_POST) && array_key_exists('create', $_POST)){

            extract($this->secureData($_POST));

            var_dump($_POST);
            die();

        }


        $this->render('admins.liens', compact('page_titre', 'styleCSS',
            'javascript', 'categories', 'datas', 'form', 'categories', 'lesimages'));

    }

    public function Create() {

        $this->Auth()->isNotLogin('a');
        $styleCSS =  $this->css();
        $javascript = $this->js();

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

            $this->render('admins.index-create', compact('form', 'page_titre',
                'styleCSS', 'javascript', 'categories'));
        }

    }

    public function Edit($id) {

        $this->Auth()->isNotLogin('a');
        $styleCSS =  $this->css();
        $javascript = $this->js();
        $sendPicture = new Upload();

        if(isset($id) && (int)$id !== 0){

            if(isset($_POST) && array_key_exists('edit', $_POST)){
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

            else {
                $page_titre = 'Modifier une publication';

                $find = $this->Blog->MyFind($id);
                $form = new BootstrapForm($find);
                $categories = $this->Blogcategorie->MyExtract('id', 'category');

                $this->render('admins.index-edit', compact('form', 'page_titre',
                    'javascript', 'styleCSS', 'categories'));
            }

        }
        else {
            $this->notFound();
        }
    }

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
}