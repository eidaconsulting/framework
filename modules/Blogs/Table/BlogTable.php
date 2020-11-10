<?php

namespace Modules\Blogs\Table;

use App\App;
use Core\Entity\Entity;
use Globals\GlobalTable;

class BlogTable extends GlobalTable
{
    public function defUpdateSee($id){
        $see = $this->MyFind($id);
        setcookie('eida_blog', sha1($id), time()+7200, '/', App::getInstance()->app_info('app_url'), 1);
        if(isset($_COOKIE['eida_blog']) && $_COOKIE['eida_blog'] !== sha1($id)){
            $see = $see->see+1;
            $this->MyUpdate($id, [
                'see' => $see
            ]);
        }
    }

    public function getOnePost($id){
        $entity = new Entity();
        $admins_table = $entity->app_info('db_prefix').'admins';

        return $this->MyQuery("SELECT bl.*, ad.name, ad.content as ucontent, ad.picture as upicture FROM meg4_blogs as bl 
                                LEFT JOIN $admins_table as ad
                                ON bl.users_id = ad.id
                                WHERE bl.id = ?", [$id], true);
    }

}