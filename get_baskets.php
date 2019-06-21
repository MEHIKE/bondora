<?php         

$fp = fopen('data.txt', 'w');
fwrite($fp, "algus");
fclose($fp);

	$json = file_get_contents('php://input');        
	$data = json_decode($json);        

	//json.put("type", type);
	//json.put("user", user_id);
	//json.put("search",search_word);
	//json.put("from", from); //from tähendab andmebaasis, millisest alates päritakse (limit 0,10) alates 0ndast 10tükki

	$type = -1;
	$user = -1;
	$search = "";
	$from = 0;

	foreach ($data as $id => $jsons) {        
		//$query= "insert into table(a,b,c) values(".$jsons->a.",".$jsons->b.",".$jsons->c.",'".$jsons->c."')";       

			$type = $jsons->type;
			$user = $jsons->user;
			$search = $jsons->search;
			$from = $jsons->from;			
			$lause= $type."*".$user."*".$search."*".$from;

		//echo $lause;        
		//echo "\n";        
	}

	require_once('Connections/connection.php');         
	mysql_select_db($database_localhost,$con);        
//	$id = $_GET['id'];        
//	$query_search = "select * from item_groups where group_id_id = '".$search."' ";        

	$query_search = "select a.*,b.name as groupname from items a,item_groups b where a.name like '%".$search."%' and a.item_group_id = b.id ";
	$query_search = $query_search."and not a.is_ended and a.user_id =".$user." limit ".$from.",10";

	$query_exec = mysql_query($query_search) or die(mysql_error());
	if (mysql_errno()) {      
		header("HTTP/1.1 500 Internal Server Error");     
		echo $query.'\n';     
		echo mysql_error();         
	}        
	else {        
		if( $query_exec!=null){        
			//$output=array();
			$output=null;
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
