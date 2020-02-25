<?php

    namespace Core\Database;

    use Core\Config;
    use PDO;

    /**
     * Class MysqlDatabase
     *
     * @package Core\Database
     */
    class MysqlDatabase extends Database
    {

        /**
         * @var
         */
        private $db_dbName;
        /**
         * @var
         */
        private $db_userName;
        /**
         * @var
         */
        private $db_password;
        /**
         * @var
         */
        private $db_hostName;
        /**
         * @var
         */
        private $pdo;

        /**
         * MysqlDatabase constructor.
         *
         * @param $db_dbName
         * @param $db_userName
         * @param $db_passwprd
         * @param $db_host
         */
        public function __construct($db_dbName, $db_userName, $db_passwprd, $db_host)
        {
            $this->db_dbName;
            $this->db_userName;
            $this->db_password;
            $this->db_hostName;
        }

        /**
         * @param $statement
         * @param null $class_name
         * @param bool $one
         * @return array|mixed|\PDOStatement
         */
        public function query($statement, $class_name = null, $one = false)
        {
            $req = $this->getPDO()->query($statement);

            if (
                strpos($statement, 'UPDATE') === 0 ||
                strpos($statement, 'INSERT') === 0 ||
                strpos($statement, 'DELETE') === 0
            ) {
                return $req;
            }

            if ($class_name === null) {
                $req->setFetchMode(PDO::FETCH_OBJ);
            } else {
                $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
            }

            //Si c'est une seule ligne a selectionner
            if ($one) {
                $datas = $req->fetch();
            } else {
                $datas = $req->fetchAll();
            }

            return $datas;
        }


        /**
         * @param $statement
         * @return false|\PDOStatement
         */
        public function queryDB($statement){
            return $this->getPDO()->query($statement);
        }


        /**
         * @return PDO
         */
        private function getPDO()
        {
            if ($this->pdo === null) {
                $config = Config::getInstance();
                $pdo = new PDO('mysql:dbname=' . $config->get('db_name') . ';host=' . $config->get('db_host') . '', $config->get('db_user'), $config->get('db_pass'));
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->exec("SET CHARACTER SET utf8");
                $this->pdo = $pdo;
            }

            return $this->pdo;
        }

        /**
         * Cette fonnction permet de prendre en compte toutes les requêtes préparées
         *
         * @param $statement : La requete SQL à executé
         * @param $attributes
         * @param null $class_name
         * @param bool $one
         * @return array|bool|mixed
         */
        public function prepare($statement, $attributes, $class_name = null, $one = false)
        {

            try {
                $req = $this->getPDO()->prepare($statement);
                $res = $req->execute($attributes);
                if (
                    strpos($statement, 'UPDATE') === 0 ||
                    strpos($statement, 'INSERT') === 0 ||
                    strpos($statement, 'DELETE') === 0
                ) {
                    return $res;
                }

                //On defini le mode de selection du fetch
                if ($class_name === null) {
                    $req->setFetchMode(PDO::FETCH_OBJ);
                } else {
                    $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
                }

                //Si c'est une seule ligne a selectionner
                if ($one) {
                    $datas = $req->fetch();
                } else {
                    $datas = $req->fetchAll();
                }

                return $datas;
            } catch (PDOException $e) {
                echo "PDOException: " . $e->getMessage();
                exit();
            }

        }


    }