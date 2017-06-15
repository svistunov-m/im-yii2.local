<?php
/**
 * Created by PhpStorm.
 * User: Максим
 * Date: 17.04.2017
 * Time: 16:45
 */

namespace app\controllers;

use app\models\Product;
use app\models\Category;
use Yii;
use yii\data\Pagination;
use yii\web\HttpException;

class CategoryController extends AppController
{
    /*
     * Главная страница
     */
    public function actionIndex() {
        $hits = Product::find()->where(['hit' => 1])->with('category')->limit(6)->all();

        $this->setMeta('E-SHOPPER');
        return $this->render('index',[
            'hits' => $hits,
        ]);
    }

    /*
     * Товары выбранной категории
     */
    public function actionView($id) {
        $id = Yii::$app->request->get('id');

        $category = Category::findOne($id);
        if (!$category) throw new HttpException(404, "Такой категории не существует");

        $query = Product::find()->where(['category_id' => $id]);
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 1,
            'forcePageParam' => false,
            'pageSizeParam' => false,
        ]);

        $products = $query->with('category')->offset($pages->offset)->limit($pages->limit)->all();
        //$products = Product::find()->where(['category_id' => $id])->all();

        // Устанавливаем мета-теги (лучше это делать в контроллере)
        $this->setMeta('E-SHOPPER | ' . $category->name, $category->keywords, $category->description);

        return $this->render('view', [
            'products' => $products,
            'category' => $category,
            'pages'    => $pages,
        ]);
    }

    public function actionSearch($q) {
        $q = trim(Yii::$app->request->get('q'));
        $this->setMeta('Поиск : ' . $q);
        $query = Product::find()->where(['like', 'name', $q]);

        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 3,
            'forcePageParam' => false,
            'pageSizeParam' => false,
        ]);

        $products = $query->with('category')->offset($pages->offset)->limit($pages->limit)->all();

        return ($q) ? $this->render('search', compact('products', 'pages', 'q')) : $this->render('search');
    }

} 