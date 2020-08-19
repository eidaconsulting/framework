<?php

namespace Core\Table;

use \App\App;
use Core\Config;
use Core\Database\Database;

/**
 * Class Table
 *
 * @package Core\Table
 */
class Table
{
    /**
     * @var string
     */
    protected $table;

    /**
     * Table constructor. Selectionne la table correspondant à la classe en prenant le nom de la classe sans le Table
     * de la fin en ajoutant le prefixe af et un s à la fin
     *
     * @param Database $db - Connexion à la base données
     */
    public function __construct (Database $db)
    {
        $this->db = $db;
        $config = Config::getInstance(ROOT . '/config/config.php');
        if (is_null($this->table)) {
            $parts = explode('\\', get_class($this));
            $class_name = end($parts);
            $this->table = $config->get('db_prefix') . strtolower(str_replace('Table', '', $class_name)) . 's';
        }

    }


    /**
     * @param      $statement  : Requete SQL pour la fonction
     * @param null $attributes : Les attribues s'il s'agit d'une fonction prepare
     * @param bool $one        : Vaut true si on veux recuperer qu'une seule ligne
     * @return mixed : Return une requete SQL complete
     */
    public function MyQuery ($statement, $attributes = null, $one = false)
    {

        if ($attributes) {
            return $this->db->prepare($statement, $attributes, str_replace('Table', 'Entity', get_class($this)), $one);
        } else {
            return $this->db->query($statement, str_replace('Table', 'Entity', get_class($this)), $one);
        }

    }


    /**
     * @param array  $options : Les options de selection sous forme d'un tableau
     *                        Ex: id => 2 ou username = admins
     * @param string $orderBy : Critère de classement de la selection. Par defaut en fonction de la date
     *                        d'ajout en decroissant. Pour changer il suffit le mettre le champs et de
     *                        preciser l'ordre. Ex: name ASC
     * @return mixed : Retourne un tableau comportant tous les ligne selectionnées. Pour un affichage par
     *                        defaut il ne faut pas mettre des informations dans la parenthèse.
     */
    public function MyAll ($options = [], $orderBy = 'add_date DESC')
    {
        $sql_parts = [];
        $attribute = [];
        if (count($options) > 0) {
            foreach ($options as $k => $v) {
                $sql_parts[] = "$k = ?";
                $attribute[] = $v;
            }
            $sql_part = implode(' AND ', $sql_parts);


            return $this->MyQuery("SELECT * FROM {$this->table} WHERE $sql_part ORDER BY $orderBy", $attribute);

        } else {
            return $this->MyQuery("SELECT * FROM {$this->table} ORDER BY $orderBy");
        }

    }


    /**
     * @param array  $options : Les options de selection sous forme d'un tableau
     *                        Ex: id => 2 ou username = admins
     * @param string $orderBy : Critère de classement de la selection. Par defaut en fonction de la date
     *                        d'ajout en decroissant. Pour changer il suffit le mettre le champs et de
     *                        preciser l'ordre. Ex: name ASC
     * @return array|mixed : Retourne un tableau comportant tous les lignes selectionnées si les
     *                        parametres de selection sont fournis et un tableau vide si rien n'est
     *                        fournie.
     */
    public function MyLike ($options = [], $orderBy = 'add_date DESC')
    {
        $sql_parts = [];
        $attribute = [];
        if (count($options) > 0) {
            foreach ($options as $k => $v) {
                $sql_parts[] = "$k LIKE ?";
                $attribute[] = (is_integer($v)) ? $v : '%' . $v . '%';
            }
            $sql_part = implode(' OR ', $sql_parts);

            return $this->MyQuery("SELECT * FROM {$this->table} WHERE $sql_part ORDER BY $orderBy", $attribute);
        } else {
            return [];
        }
    }


    /**
     * @param        $start   : Le numero de la ligne de depart de la limite
     * @param        $end     : Le nombre de ligne a selectionner
     * @param array  $options : Les options de selection sous forme d'un tableau
     *                        Ex: id => 2 ou username = admins
     * @param string $orderBy : Critère de classement de la selection. Par defaut en fonction de la date
     *                        d'ajout en decroissant. Pour changer il suffit le mettre le champs et de
     *                        preciser l'ordre. Ex: name ASC
     * @return mixed : Retourne un tableau comportant tous les ligne selectionnées. Pour un affichage par
     *                        defaut il ne faut pas mettre des informations dans la parenthèse.
     */
    public function MyLim ($start, $end, $options = [], $orderBy = 'add_date DESC')
    {
        $sql_parts = [];
        $attribute = [];
        $lim = $start . ', ' . $end;
        if (count($options) > 0) {
            foreach ($options as $k => $v) {
                $sql_parts[] = "$k = ?";
                $attribute[] = $v;
            }
            $sql_part = implode(' AND ', $sql_parts);

            return $this->MyQuery("SELECT * FROM {$this->table} WHERE $sql_part ORDER BY $orderBy LIMIT $lim", $attribute);
        } else {
            return $this->MyQuery("SELECT * FROM {$this->table} ORDER BY $orderBy LIMIT $lim");
        }
    }

    /**
     * @param $id : ID de la ligne à selectionner
     * @return mixed Selectionne une ligne d'une table en fonction de l'id fournie
     */
    public function MyFind ($id)
    {
        return $this->MyQuery("SELECT * FROM {$this->table} WHERE id = ?", [$id], true);
    }

    /**
     * @param array $options : Les options de selection sous forme d'un tableau
     *                       Ex: id => 2 ou username = admins
     * @return array|mixed : Retourne un tableau comportant tous les lignes selectionnées si les
     *                       parametres de selection sont fournis et un tableau vide si rien n'est
     *                       fournie.
     */
    public function MyWhere ($options = [])
    {
        $sql_parts = [];
        $attribute = [];

        if (count($options) > 0) {
            foreach ($options as $k => $v) {
                $sql_parts[] = "$k = ?";
                $attribute[] = $v;
            }
            $sql_part = implode(' AND ', $sql_parts);
            return $this->MyQuery("SELECT * FROM {$this->table} WHERE $sql_part", $attribute, true);
        } else {
            return [];
        }
    }


    /**
     * function pour faire automatiquement le update dans la base de données
     *
     * @param       $id : L'identifiant de la ligne a mettre à jour
     * @param array $options
     * @param null  $champ
     * @return mixed : Fait le mise a jours d'un champs
     */
    public function MyUpdate ($id, $options = [], $champ = null)
    {
        $sql_parts = [];
        $attribute = [];
        foreach ($options as $k => $v) {
            $sql_parts[] = "$k = ?";
            $attribute[] = $v;
        }

        $attribute[] = $id;
        $sql_part = implode(', ', $sql_parts);
        if ($champ) {
            return $this->MyQuery("UPDATE {$this->table} SET $sql_part WHERE $champ = ?", $attribute, true);
        } else {
            return $this->MyQuery("UPDATE {$this->table} SET $sql_part WHERE id = ?", $attribute, true);
        }
    }


    /**
     * Fonction pour Inserer de nouvelle ligne dans la base de données
     *
     * @param $options
     * @return mixed : Creer un nouveau champs dans la base de données
     */
    public function MyCreate ($options)
    {
        $sql_parts = [];
        $attribute = [];
        foreach ($options as $k => $v) {
            $sql_parts[] = "$k = ?";
            $attribute[] = $v;
        }
        $sql_part = implode(', ', $sql_parts);
        return $this->MyQuery("INSERT INTO {$this->table} SET $sql_part", $attribute, true);
    }


    /**
     * @param      $id    : ID de la ligne a supprimer
     * @param null $champ : S'il s'agit d'une suppression en fonction d'une autre colonne de champs,
     *                    il faut preciser la colonne. Dans ce cas, le parametre $id represente la
     *                    valeur que doit prendre la colonne precisée.
     *                    Fonction qui permet de supprimer une ligne d'une table
     */
    public function MyDelete ($id, $champ = null)
    {
        if (isset($champ) && !is_null($champ)) {
            $this->MyQuery("DELETE FROM {$this->table} WHERE $champ = ?", [$id]);
        } else {
            $this->MyQuery("DELETE FROM {$this->table} WHERE id = ?", [$id], true);
        }
    }


    /**
     * Function qui permet de selection l'ID de l'enrégistrement futur
     *
     * @return mixed : Derniere ligne + 1
     */
    public function MyNewId ()
    {
        $q = $this->MyQuery("SELECT MAX(id) AS id FROM {$this->table}", null, true);
        return $q->id + 1;
    }


    /**
     * @param array $options : Les options de selection sous forme d'un tableau
     *                       Ex: id => 2 ou username = admins
     * @param bool  $id      : S'il s'agit d'une mise a jour de ligne il faut preciser l'id de la ligne
     *                       concernée
     * @return array|int : Retourne un chiffre correspondant au nombre de reponse trouvée dans la
     *                       base de données, si tous les parametre sont fournis. Et retourne un tableau
     *                       si la variable option n'est pas fournie.
     */
    public function MyInUse ($options, $id = false)
    {
        $sql_parts = [];
        $attribute = [];

        if (count($options) > 0) {
            foreach ($options as $k => $v) {
                $sql_parts[] = "$k = ?";
                $attribute[] = $v;
            }
            $sql_part = implode(' AND ', $sql_parts);

            if ($id) {
                $sql_part = $sql_part . ' AND ' . $id . ' != ?';
                $attribute[] = $id;
                $query = $this->MyQuery("SELECT * FROM {$this->table} WHERE $sql_part ", $attribute);
            } else {
                $query = $this->MyQuery("SELECT * FROM {$this->table} WHERE $sql_part ", $attribute);
            }
        }

        return count($query);
    }

    /**
     * @param array $table :  un tableau contenant les ID des lignes qu'on peu supprimer.
     * @return mixed|null
     */
    public function MyIn (array $table = [], $orderBy = 'add_date DESC', string $champ = null)
    {
        $ids = array_values($table);
        if (empty($ids)) {
            return null;
        } else {
            $sql_part = implode(", ", $ids);
            if (isset($champ)) {
                return $this->MyQuery("SELECT * FROM {$this->table} WHERE $champ IN ($sql_part) ORDER BY $orderBy");
            } else {
                return $this->MyQuery("SELECT * FROM {$this->table} WHERE id IN ($sql_part) ORDER BY $orderBy");
            }
        }
    }


    /**
     * * Fonction qui permet de faire la mise a jour des vues
     *
     * @param $id : Identifiant de la ligne concernée
     */
    public function Mysee ($id)
    {
        $prefixe = Config::getInstance()->get('db_prefix');
        $cookie_name = '_' . $prefixe . $this->table . '_see';
        if (!isset($_COOKIE[$cookie_name]) || $_COOKIE[$cookie_name] != sha1($id)) {
            $data = $this->MyFind($id);
            $this->MyUpdate($id, [
                'see' => $data->see + 1
            ]);
            setcookie("$cookie_name", sha1($id), time() + 21600, '/', null, false, true);
        }
    }

    /**
     * @param null  $field
     * @param array $options : Les options de selection sous forme d'un tableau
     *                       Ex: id => 2 ou username = admins
     * @return mixed
     */
    public function MyCount ($field = null, $options = [])
    {

        if (is_null($field)) {
            $field = "*";
        }

        $sql_parts = [];
        $attribute = [];
        if (count($options) > 0) {

            foreach ($options as $k => $v) {
                $sql_parts[] = "$k = ?";
                $attribute[] = $v;
            }
            $sql_part = implode(' AND ', $sql_parts);

            $count = $this->MyQuery("SELECT COUNT($field) as nbre FROM {$this->table} WHERE $sql_part", $attribute);

        } else {
            $count = $this->MyQuery("SELECT COUNT($field) as nbre FROM {$this->table}");
        }

        return $count['0']->nbre;
    }

    /**
     * @param       $champ
     * @param array $options
     * @return mixed
     */
    public function MyCountDistinct ($champ, $options = [])
    {
        $sql_parts = [];
        $attribute = [];

        if (count($options) > 0) {

            foreach ($options as $k => $v) {
                $sql_parts[] = "$k = ?";
                $attribute[] = $v;
            }
            $sql_part = implode(' AND ', $sql_parts);

            return $this->MyQuery("SELECT COUNT (DISTINCT $champ) FROM {$this->table} WHERE $sql_part", $attribute);

        } else {
            return $this->MyQuery("SELECT COUNT (DISTINCT $champ) FROM {$this->table}");
        }

    }


    /**
     * @param        $options
     * @param string $type
     * @return mixed
     */
    public function MySearch ($options, $type = 'AND')
    {

        //Le nombre de ligne concernée
        $options = array_filter($options);

        $sql_parts = [];
        $attribute = [];

        foreach ($options as $k => $v) {
            $sql_parts[] = "$k LIKE ?";
            if (is_integer($v)) {
                $attribute[] = $v;
            } else {
                $attribute[] = '%' . $v . '%';
            }
        }
        $sql_part = implode(" $type ", $sql_parts);

        return $this->MyQuery("SELECT * FROM $this->table WHERE $sql_part", $attribute);

    }


    /**
     * @param       $key
     * @param       $value
     * @param array $options
     * @return array
     */
    public function MyExtract ($key, $value, $options = [], $value2 = null, $find = null)
    {

        $name = isset($options['name']) ? $options['name'] : false;
        $table = isset($options['table']) ? $options['table'] : false;

        $records = $this->MyAll($options, "$value ASC");
        $return = [];
        if ($value2) {
            foreach ($records as $v) {
                if ($find) {
                    $entity = new Entity();
                    $return[$v->$key] = $entity->nameFromID($table, $v->$value)->$name . ' - ' . $entity->nameFromID($table, $v->$value2)->$name;
                } else {
                    $return[$v->$key] = $v->$value . ' - <span class="indication">(' . $v->$value2 . ')</span>';
                }

            }
        } else {
            foreach ($records as $v) {
                if ($find) {
                    $entity = new Entity();
                    $return[$v->$key] = $entity->nameFromID($this->table, $v->$value)->$name;
                } else {
                    $return[$v->$key] = $v->$value;
                }
            }
        }

        return $return;
    }


    /**
     * @param       $table
     * @param       $champ1
     * @param       $champ2
     * @param bool  $one
     * @param array $options
     * @return mixed
     */
    public function MyJoin ($table, $champ1, $champ2, $one = false, $options = [])
    {
        $table = Config::getInstance()->get('db_prefix') . strtolower($table) . 's';

        $sql_parts = [];
        $attribute = [];

        if (count($options) > 0) {

            foreach ($options as $k => $v) {
                $sql_parts[] = "$k = ?";
                $attribute[] = $v;
            }

            $sql_part = implode(' AND ', $sql_parts);

            return $this->MyQuery('SELECT * FROM ' . $this->table . ' as ta
                                INNER JOIN ' . $table . ' as tb
                                  ON ta.' . $champ1 . ' = tb.' . $champ2 . '
                                  WHERE ta.' . $sql_part, $attribute, $one);
        } else {
            return $this->MyQuery('SELECT * FROM ' . $this->table . ' as ta
                                INNER JOIN ' . $table . ' as tb
                                  ON ta.' . $champ1 . ' = tb.' . $champ2, null, $one);
        }

    }


    /**
     * @param       $sum     : Le champs lequel ma sommes se fera
     * @param array $options : Les options de selection sous forme d'un tableau
     *                       Ex: id => 2 ou username = admins
     * @return mixed : Retourne la sommes
     */
    public function MySum ($sum, $options = [])
    {

        $sql_parts = [];
        $attribute = [];
        if (count($options) > 0) {

            foreach ($options as $k => $v) {
                $sql_parts[] = "$k = ?";
                $attribute[] = $v;
            }
            $sql_part = implode(' AND ', $sql_parts);

            $count = $this->MyQuery("SELECT SUM($sum) as nbre FROM {$this->table} WHERE $sql_part", $attribute);

        } else {
            $count = $this->MyQuery("SELECT SUM($sum) as nbre FROM {$this->table}");
        }
        return $count['0']->nbre;
    }

    /**
     * @param        $options
     * @param        $id
     * @param bool   $lim
     * @param string $orderBy
     * @return mixed
     */
    public function MyOthers ($options, $id, $lim = false, $orderBy = 'add_date DESC')
    {

        $sql_parts[] = "id != ?";
        $attribute[] = $id;
        if ($lim) $lim = "LIMIT $lim";

        if (count($options) > 0) {

            foreach ($options as $k => $v) {
                $sql_parts[] = "$k = ?";
                $attribute[] = $v;
            }
            $sql_part = implode(' AND ', $sql_parts);

            $datas = $this->MyQuery("SELECT * FROM {$this->table} WHERE $sql_part ORDER BY $orderBy $lim", $attribute);
        } else {
            $datas = $this->MyQuery("SELECT * FROM {$this->table} WHERE $sql_part ORDER BY $orderBy $lim", $attribute);
        }
        return $datas;
    }

}