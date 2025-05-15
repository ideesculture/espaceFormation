<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';
// if current url is https://formation.ideesculture.fr/formation/index rewrite it to https://formation.ideesculture.fr/index.php/formation/index
$url = $_SERVER['REQUEST_URI'];

(new yii\web\Application($config))->run();
