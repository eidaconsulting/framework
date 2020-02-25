<?php

namespace Core\Search;

use Core\Table\Table;
use App\App;

/**
 * Class Search
 *
 * @package Core\Search
 */
class Search
{

    /**
     * @var
     */
    private static $_instance;

    /**
     * @return Search
     */
    public static function getInstance() {
        if(self::$_instance === null){
            self::$_instance = new Search();
        }
        return self::$_instance;
    }

    /**
     * @param string $get
     * @return mixed
     */
    public function search($table, $array, $type = 'AND', $lim = null){

        //Le nombre de ligne concernée
        $array = array_filter($array);
        $total = count($array);

        $sql_parts = [];
        $attribute = [];

        if($total > 1){
            $nb = 0;
            foreach($array as $k => $v){
                $nb ++;

                if($nb<$total) {
                    $sql_parts[] = "$k LIKE ? " . $type;
                }
                else {
                    $sql_parts[] = "$k LIKE ? ";
                }

                if(is_integer($v)){
                    $attribute[] = $v;
                }
                else {
                    $attribute[] = '%'.$v.'%';
                }

            }
        }
        else {
            foreach($array as $k => $v){
                $sql_parts[] = "$k LIKE ? ";

                if(is_integer($v)){
                    $attribute[] = $v;
                }
                else {
                    $attribute[] = '%'.$v.'%';
                }
            }
        }
        $sql_part = implode(' ', $sql_parts);

        $tables = App::getInstance()->app_info('db_prefix').$table.'s';

        if(isset($lim) && $lim != ''){
            return App::getInstance()->getTable($table)
                      ->MyQuery("SELECT * FROM $tables WHERE $sql_part LIMIT $lim", $attribute);
        }
        else {
            return App::getInstance()->getTable($table)
                      ->MyQuery("SELECT * FROM $tables WHERE $sql_part ", $attribute);
        }

    }

}