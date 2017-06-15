<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-Ru',
    'defaultRoute' => 'category/index',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'asdf7a6sdf89a7sd6f8as7f9',
            'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            // это суффикс, на который будут заканчиваться все страницы
            //'suffix' => '.aspx',
            'rules' => [
                // это правило значит, что при обращении к www.site.ru/about будет обращение к контроллеру site и методу about
                /*
                'about' => 'site/about',
                'contact' => 'site/contact'
                */

                // либо можно использовать более продвинутые правила (регулярки)
                '<action:\w+>' => 'site/<action>',
                // а так обрабатывается каждый конкретный компонент
                // например убрать суффикс для главной страницы
                /*
                [
                    'pattern' => '',
                    'route' => 'site/index',
                    'suffix' => '',
                ],
                */
                // правило для категорий
                // правила пишутся от более точного к более общему
                'category/<id:\d+>/page/<page:\d+>' => 'category/view', // для чпу ссылок с get-параметрами
                'category/<id:\d+>' => 'category/view',
                'product/<id:\d+>' => 'product/view',
                //'search' => 'category/search',
                'cart/<action:\w+>/<id:\d+>' => 'cart/<action>'
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;


//svistunov_m@promis.ru