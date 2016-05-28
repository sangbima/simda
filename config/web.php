<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name' => 'SIMDA',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'A76oFqTLAs8fk2QfSVZQeoAGOM3r-sIP',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            // 'enableAutoLogin' => false,
            'enableSession' => true,
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
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => [
                      'websvc8000' => 'websvc8000',
                      // 'websvc8010' => 'websvc8010',
                      // 'websvc8020' => 'websvc8020',
                      // 'websvc8030' => 'websvc8030',
                      // 'websvc8040' => 'websvc8040',
                    ],
                    'extraPatterns' => [ // patterns
                        'OPTIONS list-announcement' => 'options',
                        'OPTIONS list-procure-type' => 'options',
                        'OPTIONS list-province' => 'options',
                        'OPTIONS list-kabupatenkota' => 'options',
                        'OPTIONS list-kecamatan' => 'options',
                        'OPTIONS list-desakelurahan' => 'options',
                        'OPTIONS list-bidang-pemerintahan' => 'options',
                        'OPTIONS list-pengguna-barang' => 'options',
                        'OPTIONS list-kuasa-pengguna' => 'options',
                        'OPTIONS list-unit-pengguna' => 'options',
                        'OPTIONS list-ruangan' => 'options',
                        'OPTIONS list-golongan-barang' => 'options',
                        'OPTIONS list-bidang-barang' => 'options',
                        'OPTIONS list-kelompok-barang' => 'options',
                        'OPTIONS list-sub-kelompok-barang' => 'options',
                        'OPTIONS list-sub-sub-kelompok-barang' => 'options',
                        'OPTIONS list-batch-kiba' => 'options',
                        'OPTIONS list-batch-kibb' => 'options',
                        'OPTIONS list-batch-kibc' => 'options',
                        'OPTIONS list-batch-kibd' => 'options',
                        'OPTIONS list-batch-kibe' => 'options',
                        'OPTIONS list-batch-kibf' => 'options',
                        'OPTIONS list-detail-kiba' => 'options',
                        'OPTIONS list-detail-kibb' => 'options',
                        'OPTIONS list-detail-kibc' => 'options',
                        'OPTIONS list-detail-kibd' => 'options',
                        'OPTIONS list-detail-kibe' => 'options',
                        'OPTIONS list-detail-kibf' => 'options',

                        'OPTIONS add-batch-kiba' => 'options',

                        // 'OPTIONS daftar-semua-petani' => 'options',
                        // 'OPTIONS daftar-lahan' => 'options',
                        // 'OPTIONS daftar-semua-lahan' => 'options',
                        // 'OPTIONS daftar-produksi' => 'options',
                        // 'OPTIONS daftar-varietas' => 'options',
                        // 'OPTIONS daftar-lokasi' => 'options',
                        // 'OPTIONS acuan-harga' => 'options',
                        // 'OPTIONS tambah-produksi' => 'options',
                        // 'OPTIONS tambah-petani' => 'options',
                        // 'OPTIONS tambah-lahan' => 'options',
                        // 'OPTIONS update-pemilik-lahan' => 'options',
                        // 'OPTIONS edit-lahan' => 'options',
                        // 'OPTIONS edit-petani' => 'options',
                        // 'OPTIONS edit-produksi' => 'options',
                        // 'OPTIONS delete-lahan' => 'options',
                        // 'OPTIONS delete-petani' => 'options',
                        // 'OPTIONS delete-produksi' => 'options',
                        // 'OPTIONS delete-varietas' => 'options',
                        // 'OPTIONS ganti-password' => 'options',
                        //'OPTIONS daftar-produksi' => 'options',
                    ]
                ]
            ]
        ],
        'assetManager' => [
            'bundles' => [
                // 'yii\web\JqueryAsset' => [
                //     'js' => []
                // ],
                // 'yii\bootstrap\BootstrapPluginAsset' => [
                //     'js' => []
                // ],
                // 'yii\bootstrap\BootstrapAsset' => [
                //     'css' => []
                // ],
            ],
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'php:d-m-Y',
            'datetimeFormat' => 'php:d-m-Y H:i:s',
            'defaultTimeZone' => 'UTC',
            'timeZone' => 'Asia/Jakarta',
        ],
    ],
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
