<?php

// change the following paths if necessary
$yiic=dirname(__FILE__).'/../../yii-1.1.13/framework/yiic.php';
$config=dirname(__FILE__).'/config/console.php';

if ($_SERVER["SERVER_NAME"] == "nippou.jp"){
    $config=dirname(__FILE__).'/config/console_deploy.php';
    $yiic=dirname(__FILE__).'/../yii-1.1.13/framework/yiic.php';
}

require_once($yiic);
