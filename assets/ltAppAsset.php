<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ltAppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        "js/html5shiv.js",
        "js/respond.min.js",
    ];

    // здесь задаем условия для подключения js скриптов
    public $jsOptions = [
        // если браузер IE меньше 9 версии
        'condition' => 'lte IE9',
        'position' => \yii\web\View::POS_HEAD,
    ];

}