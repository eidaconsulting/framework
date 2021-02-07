<?php

namespace Core\Email;

use Core\Config;


/**
 * Class Email
 *
 * @package Core\Email
 */
class Email
{

    /**
     * @var
     */
    protected $boundary;

    /**
     * Get the correct template for email according to the parameter template
     *
     * @param null $template the template type (password, activation, newsletter, welcome)
     */
    public function template ($template = null)
    {
        if (is_null($template)) {
            require(ROOT . '/layouts/email/email/email_default');
        }
        require(ROOT . '/layouts/email/email/email_' . $template);
    }

    /**
     * @return string
     */
    public function boundary ()
    {
        return "-----=" . md5(rand());
    }

    /**
     * Fonction qui permet de choisir le type de retour à la ligne entre \n et \r\n
     *
     * @param $email : Email de destination
     * @return string   : Retourne le retour à la ligne correspondant
     */
    public function line_beak ($email)
    {
        if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $email)) {
            return "\n";
        } else {
            return "\r\n";
        }
    }

    /**
     * Fonction qui defini l'entete du message
     *
     * @param      $sender      : Nom de celui qui envoie le message
     * @param      $senderEmail : Email de celui qui envoie le message
     * @param      $r           : Le type de retour à la ligne
     * @param null $bcc         : En cas d'envoie multiple, les autres email
     * @return string       : Retourne l'entete formatée
     */
    public function header ($sender, $senderEmail, $r, $bcc = null)
    {
        $header = 'From: "' . $sender . '" <' . $senderEmail . '>' . $r;
        $header .= 'MIME-Version: 1.0' . $r;
        $header .= 'Content-type: text/html; charset=utf-8' . $r;
        if (!is_null($bcc)) {
            $header .= 'Bcc: ' . $bcc . '' . $r;
        }
        $header .= ' boundary = ' . $this->boundary() . '' . $r;

        return $header;
    }

    /**
     * Utiliser pour creer un bouton dans le contenu du message
     *
     * @param $url  : Lien de destination du bouton
     * @param $name : Le message qui est affiché dans le message
     * @return string   : Retourne un bouton formaté
     */
    public function btn ($url, $name)
    {
        return '<a href="' . $url . '" 
            style="display:block; 
                    font-weight:bold; 
                    font-size:20px; 
                    margin-top:20px;
                    margin-bottom:20px; 
                    margin-left:auto; 
                    margin-right:auto; 
                    padding-left:20px;
                    padding-right:20px;
                    padding-bottom:20px; 
                    padding-top:20px; 
                    text-align:center; 
                    color:#fff; 
                    background-color:#428BCA;
                    width:40%;
                    text-decoration:none;">' . $name . '</a>';
    }

    /**
     * Fonction qui formate l'affiche d'un code spéciale
     *
     * @param $content : Contenu du code
     * @return string   : Retourne le Code formaté
     */
    public function code ($content)
    {
        return '<span style="
                        display:block; 
                        font-weight:bold; 
                        font-size:18px; 
                        margin-top:20px; 
                        margin-bottom:20px; 
                        margin-left:auto; 
                        margin-right:auto; 
                        padding-left:15px; 
                        padding-right:15px; 
                        padding-bottom:15px; 
                        padding-top:15px; 
                        text-align:center; 
                        color:#F3C35B; 
                        background-color:#eee;
                        width:90%;">' . $content . '</span>';
    }

    /**
     * @param       $content
     * @param null  $type
     * @param array $options
     */
    public function construct_email ($options = [], $type = null)
    {
        ob_start();
        extract($options);
        $this->template($type);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * @param      $content     : Contenu du message
     * @param null $to          : Desctinataire
     * @param null $objet       : Objet du message
     * @param      $sender      : Expediteur du message (Nom)
     * @param      $senderEmail : Email de l'expéditeur
     * @return bool        : Retourne true si c'est bon et false si l'email n'est pas parti
     */
    public function sendEmail ($content, $objet = null, $to = null, $sender = null, $senderEmail = null)
    {

        if (is_null($to) || $to == '') {
            $to = Config::getInstance()->get('company_email');
        }

        //Objet
        if (is_null($objet) || $objet == '') {
            $objet = 'Message de ' . strtoupper(Config::getInstance()->get('app_name'));
        }

        if (is_null($sender) || $sender == '') {
            $sender = Config::getInstance()->get('app_name');
        }

        if (is_null($senderEmail) || $senderEmail == '') {
            $senderEmail = Config::getInstance()->get('company_email');
        }

        $r = $this->line_beak($to);

        $header = $this->header($sender, $senderEmail, $r);

        return (mail($to, $objet, $content, $header));
    }


}