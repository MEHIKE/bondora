<?php         

//$fp = fopen('/opt/lampp/htdocs/shop/data.txt', 'w+');
//fwrite($fp, "algus");
//fclose($fp);
date_default_timezone_set("Europe/Helsinki");
$fp = fopen('/opt/lampp/htdocs/shop/shop.log', 'a+');
$lause = date("Y-m-d H:i:s")."----->get_json_titles.php algus \n";
fwrite($fp, $lause." \n");


//include 'devices2remote.php'; 
require_once('devices2remote.php'); 

	$json = file_get_contents('php://input');        
	$data = json_decode($json);        
        //echo $data;
        //echo $json;
	$table = "title";


	$mode = "";
	$type = -1;
	$user = -1;
	$user_id = -1;
	$user_group_id = -1;
	$user_group_user_id = -1;
	$checked = 0;
	$remote_id = -1;
	$mobile_id = -1;
	$id=-1;
	$lause="";
	$uri="";
	
	$sql="";

	$is_modified=0;
	$is_private=0;
	$is_syncable=0;
	$last_sync_time=0;
	$synced=0;
	$reminder=0;
	$time=0;
	$deleted=0;
	$modified_by=-1;
	$modified_time=0;
	$item_type=0;
	$name="";
	
	$description="";
	
	$created_time="";
	$lause="";
	$lause1="";
	$device_id="";
	$device_imei="";
	$server_device_id=0;

	$title_type=0;
	$group_title_id=0;
	$shop_id=0;
	$amount=0.00;
	

	foreach ($data as $id => $jsons) {        
			$table = $jsons->table;
			$modified_by=$jsons->modified_by;
			$modified_time="'".$jsons->modified_time."'";	
			$mode = $jsons->mode;
			$type = $jsons->type;
			$user_id = $jsons->user_id;
			$user_group_user_id = $jsons->user_group_user_id;		
			$device_id=$jsons->device_id;
			$device_imei=$jsons->device_imei;	
			$uri="'".$jsons->table_uri."'";
			
			//echo "mode=".$mode;
			if ($mode==5) {
				$paring = $jsons->sql;
				$lause = "select *,'titles' as tablename, ".$type." as type, 0 as error, 1 as in_or_out from titles ".$paring;
				//echo $lause;
			} else {
			$checked = $jsons->checked;
			$time="'".$jsons->time."'";
			$remote_id = $jsons->remote_id;
			$mobile_id = $jsons->mobile_id;
			$id = $jsons->id;
			//echo "else type=2";	
			$is_modified=$jsons->is_modified;
			$synced=$jsons->synced;
			$item_type=$jsons->item_type;

			$title_type=$jsons->title_type;
			$group_title_id=$jsons->group_title_id;
			$shop_id=$jsons->shop_id;
			$amount=$jsons->amount;

			
			if ($type == 1) {//update checked status only
	//echo "if type=1";
				if ($remote_id>0) { //update
//echo "checked=".$checked;
					$lause1="select checked,item_type,'titles' as tablename, 1 as in_or_out,".$mobile_id." as mobile_id from titles where id=".$remote_id;//." and checked=".$checked;
					$lause= "update titles set checked=".$checked.", item_type=".$item_type.", modified_time=".$modified_time." where id=".$remote_id;
					//+" and chekcked!="+$checked;
				} else { //kas lisada tühi sql või ei tee midagi - sellega tegeleb java pool
					echo "1.No exist yet";
					
					echo "error1, not exist yet.";
				}
			}
			else {
				$is_private=$jsons->is_private;
				$is_syncable=$jsons->is_syncable;
				$last_sync_time="'".$jsons->last_sync_time."'";
				$deleted=$jsons->deleted;
				$user_group_id=$jsons->user_group_id;
				$reminder=$jsons->reminder;
				$name="'".$jsons->name."'";
				$description="'".$jsons->description."'";
				$created_time="'".$jsons->created_time."'";
				
			    if ($mode<3) {
				if ($remote_id>0) { //update object
				    //echo "remote_id=".$remote_id."\n";
				    //echo "synced=".$synced."\n";
					//return;
					$where=" where id=".$remote_id;
					
					$from=" update titles set ";
					$lause= $from."name=".$name.",description=".$description.",modified_by=".$modified_by.",item_type=".$item_type.",reminder=";
					$lause=$lause.$reminder.",is_modified=";
					$lause=$lause.$is_modified.",is_private=".$is_private.",is_syncable=".$is_syncable.",user_id=";
					$lause=$lause.$user_id.",last_sync_time=".$last_sync_time;
					$lause=$lause.",synced=".$synced;
					$lause=$lause.",time=".$time;
					$lause=$lause.",modified_time=".$modified_time;
					$lause=$lause.",deleted=".$deleted;
					$lause=$lause.",created_time=".$created_time;
					$lause=$lause.",user_group_id=".$user_group_id;
					$lause=$lause.",user_group_user_id=".$user_group_user_id;
					$lause=$lause.",checked=".$checked;
					$lause=$lause.",user_id=".$user_id;
					$lause=$lause.",mobile_id=".$mobile_id;
					$lause=$lause.",type=".$type;

					$lause=$lause.",title_type=".$title_type;
					$lause=$lause.",group_title_id=".$group_title_id;
					$lause=$lause.",shop_id=".$shop_id;
					$lause=$lause.",amount=".$amount;

					$lause=$lause.$where;
					fwrite($fp, $lause." \n");
					//echo $lause;
				} else { //insert clause
					$lause= "insert into titles (checked,name,reminder,item_type,modified_by,";

					$lause=$lause."is_modified,is_private,is_syncable,last_sync_time,deleted,modified_time,";
//echo $lause;
					$lause=$lause."synced,time,description,created_time,user_group_id,user_group_user_id,
					user_id,type,mobile_id,title_type,group_title_id,shop_id,amount,checked) values ";
					
                    $lause=$lause."(".$checked.",".$name.",".$reminder.",".$item_type.",".$modified_by.",".$is_modified.",";

					$lause=$lause.$is_private.",".$is_syncable.",".$last_sync_time.",".$deleted.",".$modified_time.",";
					
                    $lause=$lause.$synced.",".$time.",".$description.",".$created_time.",".$user_group_id.",".$user_group_user_id.",".$user_id.",".$type.",".$mobile_id.",".$title_type.",".$group_title_id.",".$shop_id.",".$amount.",".$checked.")";
				}
			   } else {
				//kustutamine
					$lause= "delete from titles where id=".$remote_id;
					//echo $lause;
			   }
	}
	} //mode!=5
	require_once('Connections/connection.php');         
	mysql_select_db($database_localhost,$con);        

	$query_exec = mysql_query($lause) or die(mysql_error());
	if (mysql_errno()) {      
		header("HTTP/1.1 500 Internal Server Error");     
		echo "2.query_exec=".$query_exec.'\n';     
		echo "mysql_error=".mysql_error();         
	}        
	else {        
		if( $query_exec!=null) {        
//echo "query_exec=".$query_exec;
//echo "last insert id====".mysql_insert_id();
			$output=array();
			if ($mode==5) {
				while($row=mysql_fetch_assoc($query_exec))
					$output[]=$row;

				print(json_encode($output));
				
			} else {
			
			if ($type == 2) { //kui oli insert, kas siis teeme selecti peale et saaksime json-i? või panem elihtsalt edasi?
				$last_insert_id = mysql_insert_id();
			
			}
			
			if ($type ==1) {
		
				if ($last_insert_id<1) {		
					$last_insert_id=$remote_id;
			    }
			} else {
					$last_insert_id=mysql_insert_id();
			}
		
		if ($mode<3) {
				if ($type == 1)
					$sql= "select checked,'titles' as tablename, ".$type." as type, 0 as error, 1 as in_or_out,".$mobile_id." as mobile_id,".$mode." as mode from titles where id=".$last_insert_id;
				else
					$sql = "select *,'titles' as tablename, ".$type." as type, 0 as error, 1 as in_or_out,".$mobile_id." as mobile_id,".$mode." as mode from titles where id=".$last_insert_id;
				
				$query_exec = mysql_query($sql) or die(mysql_error());
				
				if (mysql_errno()) {      
         			       
					header("HTTP/1.1 500 Internal Server Error");     
              				
					echo "2.query_exec=".$query_exec.'\n';     
			                
					echo "mysql_error=".mysql_error();         
			        
				} 
				while($row=mysql_fetch_assoc($query_exec))       
					$output[]=$row;   

				if ($server_device_id<=0) {
					$server_device_id=getDeviceId($device_imei, $user_id, $device_id,
					$user_group_user_id, $modified_time);
				}
				doSql($user_group_user_id, $user_id, $last_insert_id, "titles", 
				json_encode($output), $mode, $modified_time, $uri, 1, $server_device_id);
     
				print(json_encode($output));             
		} else {
			//kustitamise tulemuse kirjutamine
			$sql = "SELECT *,'titles' as tablename, ".$remote_id." as id, 1 as deleted, 0 as error, 1 as in_or_out,".$mobile_id." as mobile_id,".$mode." as mode  FROM titles limit 1";
			$query_exec = mysql_query($sql) or die(mysql_error());
			if (mysql_errno()) {
					
				header("HTTP/1.1 500 Internal Server Error");
			
				echo "3.query_exec=".$query_exec.'\n';
				 
				echo "mysql_error=".mysql_error();
				 
			}
			while($row=mysql_fetch_assoc($query_exec))
				$output[]=$row;
				if ($server_device_id<=0) {
					$server_device_id=getDeviceId($device_imei, $user_id, $device_id,
					$user_group_user_id, $modified_time);
				}
				doSql($user_group_user_id, $user_id, $last_insert_id, "titles", 
				json_encode($output), $mode, $modified_time, $uri, 1, $server_device_id);

			print(json_encode($output));
		}
	}//mode!=5
	} else {
			echo "No Data"; 
		}   
	}     
	mysql_close();   

}   
$lause = date("Y-m-d H:i:s")."----->get_json_titles.php lopp \n\n\n";
fwrite($fp, $lause);
fclose($fp);
?>  
