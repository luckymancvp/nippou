<?php

return CMap::mergeArray(
	require(dirname(__FILE__).'/main.php'),
	array(
		'components'=>array(
            'db'=>array(
                'connectionString' => 'mysql:host=mysql.1freehosting.com;dbname=u298054059_tu',
                'emulatePrepare' => true,
                'username' => 'u298054059_tu',
                'password' => 'hedspi',
                'charset' => 'utf8',
            ),
		),
	)
);
