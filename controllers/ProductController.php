<?php
/**
 * Created by PhpStorm.
 * User: Максим
 * Date: 19.04.2017
 * Time: 17:35
 */

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use yii\web\HttpException;

class ProductController extends AppController
{
    public function actionView($id) {
        //$product = Product::find()->with('category')->where(['id' => $id])->one();
        $product = Product::findOne($id);
        if (!$product) throw new HttpException(404, 'Такого товара не существует');

        $hits = Product::find()->where(['hit' => 1])->with('category')->limit(5)->all();

        $this->setMeta($product->name);
        return $this->render('view', compact('product', 'hits'));
    }
} 