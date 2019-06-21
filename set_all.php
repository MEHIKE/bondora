<?php        
	$json = file_get_contents('php://input');        
	$data = json_decode($json);        
	require_once('Connections/connection.php');         
	mysql_select_db($database_localhost,$con);        
	foreach ($data as $id => $jsons) {        
		$query= "insert into table(a,b,c) values(".$jsons->a.",".$jsons->b.",".$jsons->c.",'".$jsons->c."')";       
		 //echo $query;        
		echo "\n";        
		$query_exec = mysql_query($query) or die(mysql_error());        
	}        
	mysql_close();        
	echo "Success";   
?>  
