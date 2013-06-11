<?php

return CMap::mergeArray(
	require(dirname(__FILE__).'/main.php'),
	array(
		'components'=>array(
            'db'=>array(
                'connectionString' => 'mysql:host=localhost;dbname=nippou',
                'emulatePrepare' => true,
                'username' => 'root',
                'password' => 'db_Hedspi2e',
                'charset' => 'utf8',
            ),
		),
	)
);
