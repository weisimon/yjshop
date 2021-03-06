<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log','plugins'],
    
    'modules' => [
        //整合yii2-admin wsyone 2017.12.26 
        'admin' => [
            'class' => 'mdm\admin\Module',
            //'layout' => 'left-menu',//yii2-admin的导航菜单
            'mainLayout' => '@backend/views/layouts/main.php',//选择展示的页面框架
        ],
        'plugins' => [
            'class' => 'lo\plugins\Module',
            'pluginsDir'=>[
            '@lo/plugins/core', // default dir with core plugins
           // '@common/plugins', // dir with our plugins
        ]
    ],


     ],
  
      "aliases" => [
         "@mdm/admin" => "@vendor/mdmsoft/yii2-admin",
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
            'admin/*',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ],
    ],
    //整合yii2-admin wsyone 2017.12.26 
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'loginUrl' => ['site/login'],
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
       'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                // ...
            ],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
         //整合yii2-admin wsyone 2017.12.26
        'authManager' => [
           //'class' => 'yii\rbac\PhpManager', // or use 'yii\rbac\DbManager'
             'class' => 'yii\rbac\DbManager', // 使用数据库管理配置文件
        ],
     
       //结束
        'plugins' => [
        'class' => lo\plugins\components\PluginsManager::class,
        'appId' => 2 // lo\plugins\BasePlugin::APP_BACKEND or our appId
        ],
        'view' => [
            'class' => lo\plugins\components\View::class,
        ],

     
    ],

    'params' => $params,


   
];
