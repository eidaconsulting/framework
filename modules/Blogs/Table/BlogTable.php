<?php

namespace Modules\Blogs\Table;

use App\App;
use Core\Table\Table;

class BlogTable extends Table
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

}