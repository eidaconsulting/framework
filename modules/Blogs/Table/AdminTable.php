<?php

namespace Modules\Blogs\Table;

use Core\Table\Table;

class AdminTable extends Table
{
    public function userInfo($id)
    {
        foreach ($this->MyFind($id) AS $k => $v) {
            $_SESSION[$k] = $v;
        };
    }

}