<?php
/**
 * Created by PhpStorm.
 * User: Максим
 * Date: 24.04.2017
 * Time: 17:02
 */

namespace app\controllers;


use app\models\Cart;
use app\models\Product;
use Yii;

class CartController extends AppController
{
    public function actionAdd($id) {

        //if (Yii::$app->request->isAjax) {
            $product = Product::findOne(['id' => $id]);
            if (!$product) return false;
            $session = Yii::$app->session;
            $session->open();

            $cartModel = new Cart();
            $cartModel->addToCart($product);
            $this->layout = false;
            return $this->render('cart-modal', [
                'session' => $session,
            ]);
        //}

    }


    public function actionDel($id) {
        $product = Product::findOne(['id' => $id]);
        if (!$product) return false;
        $session = Yii::$app->session;
        $session->open();

        $cartModel = new Cart();
        $cartModel->deleteProductFromCart($id);

        $this->layout = false;
        return $this->render('cart-modal', [
            'session' => $session,
        ]);
    }

    public function actionShowCart() {
        $session = Yii::$app->session;
        $session->open();

        $this->layout = false;
        return $this->render('cart-modal', [
            'session' => $session,
        ]);
    }

    public function actionClear() {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.sum');
        $session->remove('cart.qty');
        $this->layout = false;
        return $this->render('cart-modal', [
            'session' => $session,
        ]);
    }
}

/*
 * Пример структуры корзины
[
    [
        [1] => [
            'qty' => QTY,
            'name' => NAME,
            'price' => PRICE,
            'img' => IMG
        ],
        [10] => [
            'qty' => QTY,
            'name' => NAME,
            'price' => PRICE,
            'img' => IMG
        ],
    ],
    'qty' => QTY,
    'sum' => SUM
]
*/
