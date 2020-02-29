<?php 
$dsn = 'mysql:host=localhost;dbname=chat';
$username = 'root';
$pass = '';
$option = array(
	PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8'
);
try{
	$connection = new PDO($dsn,$username,$pass,$option);
	$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
}catch(PDOException $e){
	echo 'Faild Connection'.$e->getMessage();
}
?>