<?php

// change the following paths if necessary
$yiic=dirname(__FILE__).'/../yii/yiic.php';
$config=dirname(__FILE__).'/config/console.php';

$curr    = getcwd();
$folders = explode("/", $curr);
if ($folders[1] == "var"){
    $config=dirname(__FILE__).'/config/console_deploy.php';
}

require_once($yiic);
