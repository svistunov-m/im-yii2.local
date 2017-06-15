<?php
/**
 * Created by PhpStorm.
 * User: Максим
 * Date: 13.04.2017
 * Time: 15:14
 */

namespace app\models;

use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    /*
        хорошим тоном считается объявлять имя таблицы, с которой работает модель
        даже если модель и таблица в бд имеют одинаковое название
    */
    public static function tableName() {
        return 'product';
    }

    // описываем связь с продуктами
    public function getCategory() {
        /*
        В опциях указывается по какому полю связывать. В ключе - поле из таблицы, с которой связываем,
        в значении - поле из данной таблицы, которую связыаем
        */
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
} 