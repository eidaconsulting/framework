<?php

namespace Core\Ecommerce;

use App\App;
use Core\Config;

/**
 * Class Panier
 *
 * @package Core\Ecommerce
 */
class Panier
{
    /**
     * @var string
     */
    protected $datatable;

    /**
     * Panier constructor.
     *
     * @param null $datatable
     */
    public function __construct($datatable = null)
    {
        if(isset($datatable) && !is_null($datatable)){
            $this->datatable = $datatable;
        }
        else {
            $this->datatable = 'Product';
        }
        if(!isset($_SESSION['panier'])){
            $_SESSION['panier'] = [];
        }
    }

    /**
     * @param $session
     * @return float|int
     */
    public function countCard($session){
        return array_sum($session);
    }

    /**
     * @param $session
     */
    public function recalCard($session){
        //Le nom de l'input est preciser par : panier['quantity'][product->id]
        if(isset($_POST['panier']['quantity'])){
            foreach ($_POST['panier']['quantity'] as $product_id => $quantity){
                if(isset($_POST['panier']['quantity'][$product_id])){
                    $_SESSION['panier'][$product_id] = $quantity;
                }
            }
        }
    }

    /**
     * @param      $product_id
     * @param null $quantity
     */
    public function addCard($product_id, $quantity = null)
    {
        if(isset($_SESSION['panier'][$product_id])){
            if(isset($quantity)){
                $_SESSION['panier'][$product_id] += $quantity;
            }
            else {
                $_SESSION['panier'][$product_id] += 1;
            }
        }
        else {
            if(isset($quantity)){
                $_SESSION['panier'][$product_id] = $quantity;
            }
            else {
                $_SESSION['panier'][$product_id] = 1;
            }
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteLineInCard($id)
    {
        unset($_SESSION['panier'][$id]);
        return true;
    }

    /**
     * @return bool
     */
    public function cancelCard()
    {
        unset($_SESSION['panier']);
        return true;
    }

    /**
     * @param $session
     * @return float|int
     */
    public function totalCard($session)
    {
        $total = 0;

        foreach($session as $product_id => $quantity){
            $price =  App::getInstance()->getTable($this->datatable)->MyFind($product_id)->price;

            $total += $price * $quantity;
        }

        return $total;
    }

    /**
     * @param array  $datas
     * @param string $orderBy
     * @return |null
     */
    public function showProduct(array $datas = [], $orderBy = 'add_date DESC'){
        $ids = array_keys($datas);
        $config = new Config();
        $table = $config->get('db_prefix') . $this->datatable .'s';
        if(empty($ids)){
            return null;
        }
        else {
            $sql_part = implode(", ", $ids);
            return App::getInstance()->getTable($this->datatable)->MyQuery("SELECT * FROM {$table} WHERE id IN ($sql_part) ORDER BY $orderBy");
        }
    }

}