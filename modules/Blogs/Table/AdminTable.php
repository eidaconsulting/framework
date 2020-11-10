<?php

namespace Modules\Blogs\Table;

use Globals\GlobalTable;

class AdminTable extends GlobalTable
{
    public function userInfo($id)
    {
        foreach ($this->MyFind($id) AS $k => $v) {
            $_SESSION[$k] = $v;
        };
    }

}