<?php

return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Kami-Anime',
    'defaultController' => 'news',
    'language' => 'ru',

    'preload'=>array(
        'log'
    ),
    
     'aliases' => array(
        'bootstrap' => 'application.modules.bootstrap',
        'chartjs' => 'application.modules.bootstrap.extensions.yii-chartjs-master',
    ),

    'import'=>array(
        'application.models.*',
        'application.components.*',
        'application.modules.user.models.*',
        'bootstrap.*',
        'bootstrap.components.*',
        'bootstrap.models.*',
        'bootstrap.controllers.*',
        'bootstrap.helpers.*',
        'bootstrap.widgets.*',
        'bootstrap.extensions.*',
        'chartjs.*',
        'chartjs.widgets.*',
        'chartjs.components.*',
    ),

    'modules'=>array(
        'bootstrap' => array(
            'class' => 'bootstrap.BootStrapModule'
        ),
        'gii' => array(
            'generatorPaths' => array(
                'bootstrap.gii'
            ),
            'class' => 'system.gii.GiiModule',
            'password' => 'yourPassword',
            'ipFilters' => array(
                '127.0.0.1',
                '::1'
            )
        ),
        'user' => array(
            'debug' => false,
            'userTable' => 'user',
            'translationTable' => 'translation',
            //'loginType' => 7,
            'profileView' => '//profile/profile/view',
            'hybridAuthProviders' => array(
                'Facebook',
                'Twitter',
            ),
        ),
        'avatar' => array(
            
        ),
        'registration' => array(
            
        ),
        'usergroup' => array(
            'usergroupTable' => 'usergroup',
            'usergroupMessageTable' => 'user_group_message',
        ),
        'friendship' => array(
            'friendshipTable' => 'friendship',
        ),
        'profile' => array(
            'privacySettingTable' => 'privacysetting',
            'profileTable' => 'profile',
            'profileCommentTable' => 'profile_comment',
            'profileVisitTable' => 'profile_visit',
        ),
        'role' => array(
            'roleTable' => 'role',
            'userRoleTable' => 'user_role',
            'actionTable' => 'action',
            'permissionTable' => 'permission',
        ),
        'message' => array(
            'messageTable' => 'message',
        ),
    ),

    // application components
    'components'=>array(
        'bsHtml' => array(
            'class' => 'bootstrap.components.BSHtml'
        ),
        'chartjs'=>array(
            'class' => 'chartjs.components.ChartJs'
        ),
        'user'=>array(
            'class' => 'application.modules.user.components.YumWebUser',
            'allowAutoLogin'=>true,
            'loginUrl'=>array('//user/user/login'),
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName'=>false, 
            'rules'=>array(
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ),
        ),
        'db'=>array(
            'class'=>'CDbConnection',
            'connectionString' => 'mysql:host=yourHost;dbname=yourDBName',
            'emulatePrepare' => true,
            'username' => 'yourLogin',
            'password' => 'yourPassword',
            'charset' => 'utf8',
            'tablePrefix' => '', 
        ),
        'errorHandler'=>array(
            'errorAction'=>'news/error',
        ),
        'cache' => array(
            'class' => 'system.caching.CDummyCache'
        ),
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
            ),
        ),
    ),

    'params'=>array(
        'adminEmail'=>'yourmail@mail.mail',
    ),
);