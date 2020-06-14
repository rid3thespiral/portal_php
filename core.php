<?php
session_start();

$db_hostname = 'webserver.threeminds.it';
$db_username = 'vocepiu';
$db_password = 'J0j0b@j0j0b@??';
$db_name = 'vocepiu_db';

mysql_select_db($db_name, mysql_connect($db_hostname, $db_username, $db_password)) or die("Impossibile connettersi.".mysql_error());
mysql_query("CREATE TABLE IF NOT EXISTS users (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, username VARCHAR(16) NOT NULL, password VARCHAR(32) NOT NULL, email VARCHAR(60) NOT NULL, reg_ip VARCHAR(20), last_ip VARCHAR(20), reg_date INT NOT NULL, last_login INT)");

?>