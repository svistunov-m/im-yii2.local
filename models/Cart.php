<?php
/**
 * Created by PhpStorm.
 * User: Максим
 * Date: 24.04.2017
 * Time: 17:15
 */

namespace app\models;


use yii\db\ActiveRecord;

class Cart extends ActiveRecord
{
    public function addToCart($product, $qty=1) {

        // если товар с таким id уже есть в корзине, то просто добавляем его количество на 1
        if (isset($_SESSION['cart'][$product->id])) {
            $_SESSION['cart'][$product->id]['qty'] += $qty;

        } else {
            $_SESSION['cart'][$product->id] = [
                'qty' => $qty,
                'name' => $product->name,
                'price' => $product->price,
                'img' => $product->img,
            ];
        }

        // подсчет общего количества товаров и их общей суммы
        $_SESSION['cart.qty'] = (isset($_SESSION['cart.qty'])) ? $_SESSION['cart.qty'] + $qty : $qty;
        $_SESSION['cart.sum'] = (isset($_SESSION['cart.sum'])) ? $_SESSION['cart.sum'] + $qty * $product->price: $qty * $product->price;
    }

    public function deleteProductFromCart($id) {
        if (!isset($_SESSION['cart'][$id])) return false;

        $productQty = $_SESSION['cart'][$id]['qty'];
        $productTotalSum = $_SESSION['cart'][$id]['price'] * $productQty;

        unset($_SESSION['cart'][$id]);
        $_SESSION['cart.qty'] -= $productQty;
        $_SESSION['cart.sum'] -= $productTotalSum;
    }
}