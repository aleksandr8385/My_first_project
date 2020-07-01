<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'name' => 'My-Yii Cond',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        // добавили код для хранения данных авторизации в базе данных
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            ],
    ],
];
