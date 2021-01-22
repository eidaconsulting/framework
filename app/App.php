<?php

namespace App;

use Core\Config;
use Core\Database\MysqlDatabase;

class App
{

    private static $_instance;
    private $db_instance;
    private $modules = [];

    //Permet de creer des singletons

    public static function getInstance ()
    {
        if (self::$_instance === null) {
            self::$_instance = new App();
        }

        return self::$_instance;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getTable ($name)
    {
        if (isset($_GET['url']) && $_GET['url'] != '') {
            $explode = explode('/', trim($_GET['url'], '/'));

            $modules = $explode[0];

            $this->modules = ['Blogs', 'Paiements'];

            if (in_array(ucfirst($modules), $this->modules)) {
                $class_name = '\\Modules\\' . ucfirst($modules) . '\\Table\\' . ucfirst($name) . 'Table';
            } else {
                $class_name = '\\App\\Table\\' . ucfirst($name) . "Table";
            }
        } else {
            $class_name = '\\App\\Table\\' . ucfirst($name) . "Table";
        }

        return new $class_name($this->getDb());
    }


    /**
     * @return MysqlDatabase
     */
    public function getDb ()
    {
        $config = Config::getInstance();
        if (is_null($this->db_instance)) {
            $this->db_instance = new MysqlDatabase($config->get('db_name'), $config->get('db_user'), $config->get('db_pass'), $config->get('db_host'));
        }

        return $this->db_instance;
    }


    /**
     * Verifie si les champs sont vides ou pas
     *
     * @param array $fields : Liste des champs
     * @return bool : Retourne false si un des champs listés dans la tableau est vode
     */
    public function not_empty ($fields = [])
    {
        //Verifier s'il y a des champs à verifier
        if (count($fields) != 0) {
            //Faire une boucle pour verifier tous les champs
            foreach ($fields as $field) {
                //si l champs est vide ou ne comporte des espaces
                if (empty($_POST[$field]) || trim($_POST[$field]) == "") {
                    return false;
                }
            }

            //si aucun champs n'est vide
            return true;
        }
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function app_info ($key)
    {
        return Config::getInstance()->get($key);
    }

    /**
     * @param null  $type
     * @param array $erreurs
     */
    public function alerte ($type = null, $erreurs = [])
    {
        if (isset($erreurs) && count($erreurs) != 0):
            if (!isset($type)) {
                $type = 'default';
            } ?>
            <div class="alert alert-<?= $type; ?>">
                <?php
                if ($type === 'success') {
                    $titre = '<i class="fa fa-check-square-o" aria-hidden="true"></i> Succès !';
                } else if ($type === 'danger') {
                    $titre = '<i class="fa fa-times-circle" aria-hidden="true"></i> Erreur(s) !';
                } else if ($type === 'warning') {
                    $titre = '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Attention !';
                } else if ($type === 'info') {
                    $titre = '<i class="fa fa-info-circle" aria-hidden="true"></i> Information !';
                } else {
                    $titre = null;
                }
                ?>
                <strong><?= $titre; ?></strong>
                <ul class="list-unstyled">
                    <?php foreach ($erreurs as $error) {
                        echo '<li>' . $error . '</li>';
                    } ?>
                </ul>
            </div>
        <?php endif;
    }

}