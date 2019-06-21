<?php   
	$hostname_localhost ="213.168.4.222:3306";   
	$database_localhost ="shop";   
	$username_localhost ="root";   
	$password_localhost ="mehike2472";   
	$con = mysql_connect($hostname_localhost,$username_localhost,$password_localhost) or trigger_error(mysql_error(),E_USER_ERROR);   
?> 
