<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 4/18/2019
 * Time: 2:34 PM
 */

namespace app\models;


use yii\db\ActiveRecord;

class Cart extends ActiveRecord
{
    public function addToCart($good)
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        if(isset ($_SESSION['cart'][$good->id])){
            $_SESSION['cart'][$good->id]['goodQuantity'] ++;
        }
        else {
            $_SESSION['cart'][$good->id] = [
                'name' => $good['name'],
                'goodQuantity' => 1,
                'price' => $good['price'],
                'img' => $good['img'],
            ];
        }
        $_SESSION['cart.totalQuantity'] = isset($_SESSION['cart.totalQuantity']) ? $_SESSION['cart.totalQuantity']+=1 : $_SESSION['cart.totalQuantity'] = 1;
        $_SESSION['cart.totalPrice'] = isset($_SESSION['cart.totalPrice']) ? $_SESSION['cart.totalPrice'] += $good['price'] : $good['price'];


        // $_SESSION['cart']['one'] = 'one';
    }

    public function updateCart($id){
        $quantity = $_SESSION['cart'][$id]['goodQuantity'];
        $price = $_SESSION['cart'][$id]['price']*$quantity;

        $_SESSION['cart.totalPrice'] -= $price;
        $_SESSION['cart.totalQuantity'] -= $quantity;
        unset($_SESSION['cart'][$id]);
        if(count($_SESSION['cart']) == 0){
            unset($_SESSION['cart']);
        }

    }
}