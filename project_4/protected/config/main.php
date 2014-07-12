<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
include_once 'config.local.php';
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => $THEME_NAME,
    'theme' => $THEME,
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.helpers.*',
        'application.components.*',
        'ext.yii-mail.YiiMailMessage',
        'ext.esearch.*',
    ),
    'defaultController' => 'home',
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123456',
        // If removed, Gii defaults to localhost only. Edit carefully to taste.
        //'ipFilters'=>array('127.0.0.1','::1'),
        ),
        'admin' => array(
            'defaultController' => 'adminpanel'
        ),
    ),
    // application components
    'components' => array(
        'cache' => array(
            'class' => 'system.caching.CFileCache',
        ),
        'settings' => array(
            'class' => 'application.extensions.CmsSettings',
            'cacheComponentId' => 'cache',
            'cacheId' => 'global_website_settings',
            'cacheTime' => 84000,
            'tableName' => '{{_settings}}',
            'dbComponentId' => 'db',
            'createTable' => true,
            'dbEngine' => 'InnoDB',
        ),
        'image' => array(
            'class' => 'application.extensions.image.CImageComponent',
            'driver' => 'GD',
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'loginUrl' => array('admin/adminpanel/login'),
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'caseSensitive' => true,
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>/page' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                
            ),
        'showScriptName'=>false,
        ),
        /* 'widgetFactory'=>array(
          'widget'=>array(

          )
          ), */

        /* 'db'=>array(
          'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
          ), */
        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => "mysql:host=$MYSQL_HOSTNAME;dbname=$MYSQL_DATABASE",
            'emulatePrepare' => true,
            'username' => $MYSQL_USERNAME,
            'password' => $MYSQL_PASSWORD,
            'tablePrefix' => $TABLE_PREFIX,
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true,
        ),
        'authManager' => array(
            'class' => 'CDbAuthManager',
            'connectionID' => 'db',
            'itemTable' => 'ecom_authitem',
            'assignmentTable' => 'ecom_authassignment',
            'itemChildTable' => 'ecom_authitemchild'
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                // uncomment the following to show log messages on web pages
                array(
                    'class' => 'CWebLogRoute',
                ),
            ),
        ),
        'session' => array(
            'class' => 'CDbHttpSession',
            'connectionID' => 'db',
            'sessionTableName' => 'ecom_session'
        ),
        
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => require(dirname(__FILE__).'/params.php'),
);
