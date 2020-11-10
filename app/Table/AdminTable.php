<?php

namespace App\Table;

use Globals\GlobalTable;

class AdminTable extends GlobalTable
{

    public function userInfo ($id)
    {
        foreach ($this->MyFind($id) as $k => $v) {
            $_SESSION[$k] = $v;
        }
    }

}