<?php
class Conexion{
	public static function Conectar(){
		//$servername = "mysql.hostinger.es";
		$servername = "localhost";
		$username = "u598213897_admin";
		$password = "dietsana";
		//$dbname = "u598213897_dieta";
		$dbname = "dietsana";
		return new PDO("mysql:host=".$servername. ";dbname=".$dbname, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	}
}
?>