<?php

namespace Core\Database;


use Core\Config;
use Core\Controller\Controller;
use Core\Entity\Entity;

/**
 * Class dbCreate
 *
 * @package Core\Database
 */
class dbCreate {

    /**
     * @param $type
     * @return mixed|null
     */
    private function config($type){
        $config = Config::getInstance();

        return $config->get($type);
    }

    /**
     * @return string
     */
    public function adminsCreate() {

        $requete = '
            CREATE TABLE IF NOT EXISTS `'.$this->config('db_prefix').'admins` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `username` varchar(50) NOT NULL,
                `password` varchar(255) NOT NULL,
                `email` varchar(255) DEFAULT NULL,
                `name` varchar(255) DEFAULT NULL,
                `phone` varchar(45) DEFAULT NULL,
                `userright` int(11) DEFAULT NULL,
                `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `state` int(11) DEFAULT \'1\',
                PRIMARY KEY (id)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
        ';

        return $requete;
    }

    /**
     * @return string
     */
    public function usersCreate() {

        $requete = '
            CREATE TABLE IF NOT EXISTS `'.$this->config('db_prefix').'users` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `email` varchar(255) DEFAULT NULL,
                `username` varchar(255) DEFAULT NULL,
                `phone` varchar(255) DEFAULT NULL,
                `password` varchar(255) DEFAULT NULL,
                `token` varchar(255) DEFAULT NULL,
                `uniqid` varchar(255) DEFAULT NULL,
                `state` tinyint(1) DEFAULT \'0\',
                `userright` tinyint(2) DEFAULT \'0\',
                `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
        ';

        return $requete;
    }

    /**
     * @return string
     */
    public function blogcategoriesCreate() {

        $requete = '
            CREATE TABLE IF NOT EXISTS `'.$this->config('db_prefix').'blogcategories` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `category` varchar(255) DEFAULT NULL,
                `slug` varchar(255) DEFAULT NULL,
                `state` int(11) DEFAULT NULL,
                `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
        ';

        $requete .= '
            INSERT INTO `'.$this->config('db_prefix').'blogcategories` (`id`, `category`, `slug`, `state`, `add_date`) VALUES
                (1, \'Web et Web Design\', \'web-et-web-design\', NULL, \'2018-09-21 16:34:15\'),
                (2, \'Réseaux sociaux\', \'reseaux-sociaux\', NULL, \'2018-11-02 21:46:53\');
        ';

        return $requete;
    }

    /**
     * @return string
     */
    public function blogsCreate() {

        $requete = '
            CREATE TABLE IF NOT EXISTS `'.$this->config('db_prefix').'blogs` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `title` varchar(75) DEFAULT NULL,
                `category_id` int(11) NOT NULL,
                `image` varchar(255) DEFAULT NULL,
                `content` longtext,
                `slug` varchar(255) DEFAULT NULL,
                `state` int(11) NOT NULL DEFAULT \'1\',
                `featuring` int(11) NOT NULL DEFAULT \'0\',
                `see` int(11) NOT NULL DEFAULT \'0\',
                `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
        ';

        $requete .= '
            INSERT INTO `'.$this->config('db_prefix').'blogs` (`id`, `title`, `category_id`, `city_id`, `image`, `content`, `slug`, `state`, `featuring`, `see`, `add_date`) VALUES
              (1, \'Comment aider les moteurs de recherche à mieux classer votre site ?\', 12, NULL, \'afrilocation-blog_7.png\', \'<p>Si les moteurs de recherche peuvent retrouver facilement votre site, alors les potentiels clients aussi. C’est pourquoi l’optimisation de l’ensemble de son site Internet pour apparaître dans les moteurs de recherche est importante.</p><p>L’objectif de l’optimisation d’une page web pour aider les moteurs de recherche à mieux le classer est de faire en sorte de communiquer un message clair et cohérent au moteur de recherche quel que soit l’endroit de la page ou il examine.</p><p>Vous allez pouvoir, à travers cette publication, savoir les quatre éléments qu’il faut optimiser sur les pages de votre site web pour permettre aux moteurs de recherche de mieux classer vos pages et par conséquent mieux classer votre site Internet. </p><p>Comme nous avons décidé de procéder désormais, nous allons utiliser un exemple concret pour que vous puissiez mieux comprendre ceux dont nous parlons et surtout appliquer sur vos propres besoins.</p><p>Imaginons que vous gérez une entreprise dans la communication digitale dénommée « AGENCE WEB » et que vous cherchez à optimiser une page sur la communication digitale. </p><p>Sur votre page, vous allez prendre en compte les quatre éléments principaux qui indiquent aux moteurs de recherche que votre page traite de la communication digitale. Il s’agit des éléments suivants :</p><p class=\"MsoNormal\"><b>Les balises META</b></p><ul><li><span style=\"color: var(--semi-text-color) ; text-indent: -18pt;\">La balise title</span></li><li><span style=\"color: var(--semi-text-color) ; text-indent: -18pt;\">La balise description</span></li></ul><p style=\"text-indent: -18pt;\"><o:p></o:p></p><p class=\"MsoNormal\"><b>Le contenu de la page</b></p><ul><li><span style=\"color: var(--semi-text-color) ; text-indent: -18pt;\">L’entête de la page</span></li><li>Le contenu de la page</li></ul><h3>Les balises méta</h3><p>Ils ne sont pas visibles sur une page web, sauf si vous regardez son code en cliquant sur la combinaison de touches (Ctrl + u). Ils se trouvent sans l’entête de la page et sont des messages intégrés qui aident le moteur de recherche à identifier ce qui se trouve sur la page.  Ils contiennent en particulier le titre  <font face=\"Courier New\"><title></font> et la méta description <font face=\"Courier New\"><meta name=\"description\">.</font></p><p class=\"MsoNormal\">Tous les deux sont importants parce que ce sont ces deux\r\ninformations qui sont affichées pour générer un résultat de recherche pour une\r\npage. Comme l’illustre l’image ci-dessous, le titre est utilisé pour générer la\r\npremière ligne qui apparaît tandis que la méta description est utilisée pour\r\ngérer la phase courte qui accompagne.</p><h3>Le titre</h3><p class=\"MsoNormal\">Pour la page communication digitale, il est important que\r\nl’expression « <b>communication\r\ndigitale</b> » apparaisse dans le titre et la méta description.<span style=\"color: var(--semi-text-color) ;\">Un bon titre pourrait être : </span><b style=\"color: var(--semi-text-color) ;\"><i>MON AGENCE WEB - Agence de\r\nCommunication digitale</i></b></p><p class=\"MsoNormal\"><o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\">Généralement le titre de votre page doit être cours et\r\nprécis. Il doit prendre en compte que le mot-clé principal. Celui-ci décrit le\r\ncontenu de la page et met en évidence le nom de la page.</p><h3>La méta description</h3><h2><o:p></o:p></h2><p class=\"MsoNormal\">Une bonne <b>méta\r\ndescription</b> est généralement composée d’une phrase ou de deux phrases\r\ncourtes. Pour rendre cohérent le message, elle doit également renforcer les mêmes\r\nmots-clés ou expressions. Elle doit également être concise, claire,\r\nintéressante et surtout correspondre au contenu de la page.<o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\"><span style=\"color: var(--semi-text-color) ;\">Une bonne description serait :</span></p><p class=\"MsoNormal\"><b><i>Nous mettons en place une stratégie de <span style=\"color:red\">communication\r\ndigitale </span>optimale, claire et efficace afin de vous permettre de mieux\r\ncommuniquer, de donner plus de visibilité à vos activités et atteindre vos\r\nobjectifs de vente. Optimisez votre présence en ligne en cliquant ici.</i></b></p><p class=\"MsoNormal\"><b><i><o:p></o:p></i></b></p><h3>Le contenu de la page</h3><p>En dehors de ses balises META (<i>title et description</i>), vous devez également tenir compte du contenu de votre page, de ce qui se trouve sur votre page proprement dite. C’est ce que les gens qui visitent votre site et pas seulement les moteurs de recherche voient réellement. C’est ça qui incitera les utilisateurs à cliquer sur un éventuel bouton j’aime, ou à partager votre contenu.</p><p>Pour cette partie, il y a deux choses que vous pouvez optimiser pour aider les moteurs de recherche à correctement classer vos contenus. Il s’agit de l’entête et du texte de la page.</p><h3>L’entête</h3><p>Comme les balises méta, les entêtes sont intégrés au code HTML de votre page par contre ils sont également visibles par les internautes et lisibles par les moteurs de recherche.</p><p>Souvent, ils sont la première phase présente sur une page. Ils sont affichés en haut de la page. Et permettent aux internautes d’identifier clairement de quoi parle le texte de la page. Cela fonctionne aussi bien pour les internautes que pour les moteurs de recherche qui les utilisent pour classer également la page.</p><p>Ici, « <b><i>Communication digitale</i></b> » serait un bon entête pour la page. Vous pouvez au besoin vous permettre d’ajouter un ou deux mots pour être encore plus précis. On peut avoir par exemple comme titre :</p><p>« <b><i>La communication digitale chez nous</i></b> » ou « <b><i>notre stratégie de communication digitale</i></b> ».</p><p>Par contre, ce que vous devez prendre l’habitude de faire pour mieux optimiser votre page est d’avoir exactement les mêmes contenus au niveau de votre balise méta <font face=\"Courier New\"><title></font> et au niveau de l’entête de la page.</p><h3>Le texte</h3><p>Pour ne pas rentrer dans les détails techniques et vous apprendre comment rédiger un contenu de site web, je dirai enfin que si vous écrivez un paragraphe sur la communication digitale, vous aurez tendance à utiliser naturellement plus souvent ce mot ou expression dans le texte. N’exagérez pas en utilisant trop souvent ce mot-clé. Car les moteurs de recherche risquent de considérer le texte comme du spam. Souvenez-vous que vous écrivez avant tout pour des personnes donc veillez à ce que votre message soit clair.</p><p>Vous savez maintenant ce que vous allez faire pour optimiser les pages web de votre entreprise afin d’aider les moteurs de recherche à mieux classer votre page. Vous savez les quatre points importants aux moteurs de recherche que vous devez optimiser sur votre page pour atteindre vos résultats. </p><p>À présent, dans chaque cas vous pouvez indiquer les informations concernant votre page pour que, quels que soient les endroits examinés par les moteurs de recherche ils trouvent les informations cohérentes et claires sur le contenu de votre page.</p><div><br></div><h2><o:p></o:p></h2><div><br></div><h2><o:p></o:p></h2>\', \'comment-aider-les-moteurs-de-recherche-a-mieux-classer-votre-site\', 1, 0, 106, \'2018-10-12 15:35:35\');
           ';

        return $requete;
    }

    /**
     * @return string
     */
    public function commentsCreate() {

        $requete = '
            CREATE TABLE IF NOT EXISTS `'.$this->config('db_prefix').'comments` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(255) DEFAULT NULL,
                `email` varchar(255) DEFAULT NULL,
                `post_id` int(11) NOT NULL,
                `comment` text,
                `state` int(11) NOT NULL DEFAULT \'0\',
                `comment_id` int(11) DEFAULT NULL,
                `user_ip` varchar(255) DEFAULT NULL,
                `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
        ';

        $requete .= '
            INSERT INTO `'.$this->config('db_prefix').'comments` (`id`, `name`, `email`, `post_id`, `comment`, `state`, `comment_id`, `user_ip`, `add_date`) VALUES
              (39, \'DouglasKaT\', \'fghserf@bigmir.net\', 7, \'http://dfssssghjrtbz.com/ <br />\r\n<a href=http://dfssssghjrtbz.com/#>tadalafil 5mg</a> <br />\r\n<a href=\"http://dfssssghjrtbz.com/#\">buy cialis delived next day</a>\', 0, NULL, \'31.184.238.114\', \'2018-12-11 12:01:34\');
            ';

        return $requete;
    }

    /**
     * @return string
     */
    public function blognewslettersCreate() {

        $requete = '
            CREATE TABLE IF NOT EXISTS `'.$this->config('db_prefix').'blognewsletters` (
                `id` int(11) NOT NULL,
                `email` varchar(255) DEFAULT NULL,
                `ip` varchar(255) DEFAULT NULL,
                `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;            
        ';

        $requete .= '
            ALTER TABLE `eida_blognewsletters`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
            ';

        return $requete;
    }

    /**
     * @return string
     */
    public function profilsCreate() {

        $requete = '
            CREATE TABLE IF NOT EXISTS `'.$this->config('db_prefix').'profils` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `users_id` int(11) DEFAULT NULL,
                `name` varchar(255) DEFAULT NULL,
                `secondname` varchar(255) DEFAULT NULL,
                `district` varchar(255) DEFAULT NULL,
                `situation` varchar(255) DEFAULT NULL,
                `project` varchar(255) DEFAULT NULL,
                `email` varchar(255) DEFAULT NULL,
                `date` varchar(255) DEFAULT NULL,
                `hour` varchar(255) DEFAULT NULL,
                `observation` text,
                `phone` varchar(20) DEFAULT NULL,
                `profession` varchar(255) DEFAULT NULL,
                `city_id` int(11) DEFAULT NULL,
                `country_id` int(11) DEFAULT NULL,
                `activate_date` timestamp NULL DEFAULT NULL,
                `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
        ';

        return $requete;
    }

    /**
     * @return string
     */
    public function adminsInsert() {
        $requete = '
            INSERT INTO `'.$this->config('db_prefix').'admins` (`id`, `username`, `password`, `email`, `name`, `phone`, `userright`, `add_date`, `state`) 
            VALUES
            (1, \'admins\', \'$2y$10$2WTTfoM9COts1rWctfuId.1rsywEl8/h3ovSesZ3e9PBE59qvQsny\', \'azziz.bello2@gmail.com\', \'Azziz BELLO\', \'97334389\', 1, \'2017-07-04 13:12:28\', 1),
            (2, \'didierfabrice\', \'$2y$10$ZD105HLdCfvg64ybDkvYPOJQ4C3Pr.atQOlzQpCpw6oZWHC9gTGYW\', \'didier.fabrice@gmail.com\', \'DIDIER Fabice\', \'98989898\', 2, \'2017-07-06 00:24:58\', 1),
            (3, \'lucgnancadja\', \'$2y$10$LJTicMTw8BEKnp21e7IzQOwat8H0aOWZExfeBHHdBKhYSwJyax2.W\', \'luc.gnancadja@gmail.com\', \'Luc GNANCADJA\', \'68585858\', 3, \'2017-07-06 00:26:44\', 1);
        ';

        return $requete;
    }

    /**
     * @return MysqlDatabase
     */
    private function table() {
        $db_dbName = $this->config('db_name');
        $db_userName = $this->config('db_user');
        $db_passwprd = $this->config('db_pass');
        $db_host = $this->config('db_host');

        $table = new MysqlDatabase($db_dbName, $db_userName, $db_passwprd, $db_host);
        return $table;
    }

    /**
     *
     */
    public function execute() {

        if($this->config('admin') == true){
            $this->table()->queryDB($this->adminsCreate());
            $this->table()->queryDB($this->adminsInsert());
        }

        if($this->config('user') == true){
            $this->table()->queryDB($this->usersCreate());
            $this->table()->queryDB($this->profilsCreate());
        }

        if($this->config('blog') == true){
            $this->table()->queryDB($this->blogsCreate());
            $this->table()->queryDB($this->blogcategoriesCreate());
            $this->table()->queryDB($this->commentsCreate());
            $this->table()->queryDB($this->blognewslettersCreate());
        }

        $controller = new Controller();
        $entity = new Entity();

        $controller->alertDefine('Base de données configurée avec succes', 'success');
        $controller->redirection($entity->url());

    }

}