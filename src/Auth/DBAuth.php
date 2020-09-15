<?php

namespace core\Auth;

use App\App;
use Core\Config;
use Core\Database\Database;

/**
 * Class DBAuth
 *
 * @package core\Auth
 */
class DBAuth
{

    /**
     * Injection de dependanca
     *
     * @param Database $db
     */
    public function __construct (Database $db)
    {
        $this->db = $db;
    }


    /**
     * function qui permet de connecter l'utilisateur
     *
     * @param        $username
     * @param        $password
     * Return un boolean
     * @param string $type
     * @return bool
     */
    public function loginUser (string $username, string $password, $type = 'u')
    {
        if ($type === 'a') {
            $user = $this->db->prepare('SELECT * FROM ' . Config::getInstance()->get('db_prefix') . 'admins WHERE email = ? OR username = ?', [$username, $username], null, true);
        } else if ($type === 'u') {
            $user = $this->db->prepare('SELECT * FROM ' . Config::getInstance()->get('db_prefix') . 'users WHERE email = ? AND state = 1', [$username], null, true);
        }
        $session = 'auth' . ucfirst($type);
        if ($user) {
            if (password_verify($password, $user->password)) {
                $_SESSION[$session] = $user->id;
                $this->getConnectInfos($user->id, $type);

                return true;
            }
        }

        return false;
    }


    /**
     * Permet de recupérer les informations de l'utilisateurs en session
     *
     * @param $id   : Id de la ligne à selectionnée
     * @param $type : user ou admin. Correspond au type d'utilisateur entre
     */
    public function getConnectInfos (int $id, $type = 'u')
    {
        if ($type === 'a') {
            $userInfos = $this->db->prepare('SELECT * FROM ' . Config::getInstance()->get('db_prefix') . 'admins WHERE id = ? ', [$id], null, true);
        } else if ($type === 'u') {
            $userInfos = $this->db->prepare('SELECT * FROM ' . Config::getInstance()->get('db_prefix') . 'users as u
                        INNER JOIN ' . App::getInstance()->app_info('db_prefix') . 'profils' . ' as p
                         ON u.id = p.users_id
                         WHERE u.id = ? AND u.state = 1', [$id], null, true);
        }
        foreach ($userInfos as $k => $v) {
            $_SESSION[$type][$k] = $v;
        }
        $_SESSION['user_token'] = bin2hex(random_bytes(15));
    }

    /**
     * Permet de verifier si la personne est déja connecté
     *
     * @param $type
     * @return mixed
     */
    public function isLogin ($type = 'u')
    {
        if (isset($_SESSION['auth' . ucfirst($type)])) {
            $url = App::getInstance()->app_info('app_url') . '/' . strtolower($type) . '/index';
            header('Location: ' . $url);
        }
    }

    /**
     * @param string $type
     */
    public function isNotlogin ($type = 'u')
    {
        if (!isset($_SESSION['auth' . ucfirst($type)])) {
            $url = App::getInstance()->app_info('app_url') . '/' . strtolower($type) . '/login';
            header('Location: ' . $url);
        }
    }

}