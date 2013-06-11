<?php
/**
 * Created by JetBrains PhpStorm.
 * User: luckymancvp
 * Date: 2/15/13
 * Time: 8:50 PM
 * To change this template use File | Settings | File Templates.
 */
class ImportDBCommand extends CConsoleCommand {
    public function run($args)
    {
    	$db = $this->getDBInfo();
    	$link = $this->connect($db);

		exec($this->createCommand($db));
		die();
    	
    	$sql  = "DROP DATABASE IF EXISTS {$db["dbName"]} ;";
        $sql .= "CREATE DATABASE IF NOT EXISTS {$db["dbName"]} ;";
        $sql .= "USE {$db["dbName"]};";

        $dataPath = Yii::getPathOfAlias("application"). "/data";
        if ($handle = opendir($dataPath)){
        	while (false !== ($entry = readdir($handle))){
        		if ($this->getExt($entry) == "sql"){
        			$sql .= file_get_contents($dataPath . "/". $entry);
        		}
        	}
        	closedir($handle);
        }

        echo $sql;
		mysql_query($sql);
    }

    private function getDBInfo(){
    	$config = Yii::app()->getComponents(false);
    	$connString = $config["db"]["connectionString"];
        $connArr    = preg_split("/[=;]/", $connString);

        return array(
        	'host'     => $connArr[1],
        	'dbName'   => $connArr[3],
        	'username' => $config["db"]["username"],
        	'password' => $config["db"]["password"],
        );
    }

    private function connect($db){
    	$link = mysql_connect($db["host"], $db["username"], $db["password"]);
		if (!$link) {
		    die('Could not connect: ' . mysql_error());
		}
		echo 'Connected successfully';
		return $link;
    }

    private function createCommand($db){
    	$MYSQL="mysql -u{$db["username"]} -p{$db["password"]}";
    	$dataPath = Yii::getPathOfAlias("application"). "/data";
    	return <<<CMD

#!/usr/bin/env sh

echo 'Drop database'
$MYSQL -e "DROP DATABASE IF EXISTS {$db["dbName"]}"

echo 'Create database'
$MYSQL -e "CREATE DATABASE {$db["dbName"]} DEFAULT CHARACTER SET UTF8"

echo 'Create table'

for SQL in `find $dataPath | grep .sql`
do
    $MYSQL {$db["dbName"]} < \$SQL
done

CMD;
    }

    /**
     * Get extension of a file 
     *
    */ 
    private function getExt($entry){
    	$arr = explode(".", $entry);
    	return $arr[count($arr) - 1];
    }
}