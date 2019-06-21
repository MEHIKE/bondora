<?php
	//mysql_connect("localhost","root","mehike2472");
	$usergroupuser_id = $_GET['par'];
	$email = $_GET['em'];
	$username = $_GET['kas'];

    $teade = "algus: usergroupuser_id=".$usergroupuser_id." email=".$email." username=".$username;
    
	$fp = fopen('/opt/lampp/htdocs/shop/data.txt', 'w+');
	fwrite($fp, $teade);
	fclose($fp);

    echo $teade;
    
	require_once('Connections/connection.php');         
	mysql_select_db($database_localhost,$con);        

	mysql_set_charset('utf8',$con);

	$output=array();
 
	//$q=mysql_query("SELECT * FROM item_groups WHERE group_id_id='".$_REQUEST['id']."'");
	//while($e=mysql_fetch_assoc($q)) {
	//        $output[]=$e;
	//	echo $e['name'];
	//} 
	//print(json_encode($output));

	//$export = json_encode($output); 
	//$import = json_decode($export);

	//echo $_REQUEST['second'];
	//print_r($import);

	 
	mysql_close();
?>