<?php         
	require_once('Connections/connection.php');         
	mysql_select_db($database_localhost,$con);        
	$timestamp = $_GET['timestamp'];        
	$query_search = "select * from table where a = '".$timestamp."' ";        
	$query_exec = mysql_query($query_search) or die(mysql_error());        
	if (mysql_errno()) {      
		header("HTTP/1.1 500 Internal Server Error");     
		echo $query.'\n';     
		echo mysql_error();         
	}        
	else {        
		if( $query_exec!=null){        
			while($row=mysql_fetch_assoc($query_exec))       
			$output[]=$row;        
			print(json_encode($output));             
		}             
		else {
			echo "No Data"; 
		}        
	mysql_close();   
	}   
?>  
