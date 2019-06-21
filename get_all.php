<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Demo</title>
<link rel="stylesheet" href="css/ex.css" type="text/css" />
<style type="text/css">
table.demoTbl {
    border-collapse: collapse;
}

#tblCap {
    font-weight:bold;
    margin:1em auto .4em;
}

table.demoTbl .title {
    width:200px;
}
table.demoTbl .prices {
    width:120px;
}

table.demoTbl td, table.demoTbl th {
    padding: 6px 8px;
    border: 1px solid #000;
}

table.demoTbl th.first {
    text-align:left;
}
table.demoTbl td.num {
    text-align:right;
}
    
table.demoTbl td.foot {
    text-align: center;
}

</style>
</head>
<body>
<?php
	//mysql_connect("localhost","root","mehike2472");
	echo "algus \n\n";
	$fp = fopen('bondora.log', 'a+');
	$lause = date("Y-m-d H:i:s")."----->index.php algus \n";
	fwrite($fp, $lause." \n"); 
	echo "fail avatud \n\n";
	
	require('includes/html_table.class.php');
	
	//require_once('Connections/connection.php');         
	//mysql_select_db($database_localhost,$con);        
	//mysql_set_charset('utf8',$con);
	//$this->query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	//mysql_select_db("pood");

	if (isset($_GET['id']) && $_GET['second'] != '') {
		echo "get algus \n \n";
		// get tag
		$tag = $_GET['id'];
	
		// include db handler
		require_once 'include/DB_Functions.php';
		$db = new DB_Functions();
	
		// response Array
		$response = array("tag" => $tag, "error" => FALSE);	
	
		// check for user
		$filters = $db->getAuctionFiltersAll();
		print_r($filters);
		if ($filters != false) {
			$response["error"] = FALSE;
			echo $filters[0][0];
			$response["unique_id"] = $filters[0][0];
			$response["filter"]["id"] = $filters[0][0];
			$response["filter"]["isActive"] = $filters[0][1];
			$response["filter"]["user"] = $filters[0][2];
			//echo $filters;
			echo $filters[1][0];
			
		}
		
		echo "<table><tr><th>Title</th><th>Price</th><th>Number</th></tr>";
		foreach($filters as $v){
			echo "<tr>";
			foreach($v as $vv){
				echo "<td>{$vv}</td>";
			}
			echo "<tr>";
		}
		echo "</table>";
		
		$PRODUCTS = array(
				'choc_chip' => array('Chocolate Chip Cookies', 1.25, 10.00),
				'oatmeal' => array('Oatmeal Cookies', .99, 8.25),
				'brownies' => array('Fudge Brownies', 1.35, 12.00)
		);
		
		$tbl = new HTML_Table('', 'demoTbl');
		$tbl->addCaption('Dessert Favorites', 'cap', array('id'=> 'tblCap') );
		
		$tbl->addRow();
		
		$tbl = new HTML_Table('', 'demoTbl');
		$tbl->addCaption('Dessert Favorites', 'cap', array('id'=> 'tblCap') );
		
		$tbl->addRow();
		// arguments: cell content, class, type (default is 'data' for td, pass 'header' for th)
		// can include associative array of optional additional attributes
		$tbl->addCell('Product', 'first', 'header');
		$tbl->addCell('Single Item', '', 'header');
		$tbl->addCell('1 Dozen', '', 'header');
		
		foreach($PRODUCTS as $product) {
			list($name, $unit_price, $doz_price ) = $product;
			print_r($product);
			echo "\n\n järjest NAME=".$name." \n\n";
			$tbl->addRow();
			$tbl->addCell($name);
			$tbl->addCell('$' . number_format($unit_price, 2), 'num' );
			$tbl->addCell('$' . number_format($doz_price, 2), 'num' );
		}
		foreach($filters as $filter1) {
			print_r($filter1);
			//echo "LIST1 id=".$filter1['id']+" name=".$filter1['user']."  isdone=".$filter1['isDone']."\n\n";
			//echo "id?=".$filter1['id']." \n\n";
			list($id, $user, $isDone ) = $filter1;
			$tbl->addRow();
			$tbl->addCell($user);
			$tbl->addCell('$' . number_format($id, 2), 'num' );
			$tbl->addCell('$' . $isDone, 'boolean' );
			echo "\n\n FILTER=".$user."   id=".$id." \n\n";
			foreach($filter1 as $name=>$name1){
				echo "VÄÄRTUS ".$name1."  ja NAM=".$name." \n\n";
			}
		}
		
		$tbl->addRow();
		$tbl->addCell('All so very yummy!', 'foot', 'data', array('colspan'=>3) );
		
		echo $tbl->display();
		
		$value = array( 0 => 'low', 2 => 'medium', 1 => 'higher');
		list($a, $b, $c) = $value;
		echo $a." ".$b." ".$c;
		list($d, $e) = $value;
		echo $d." ".$e;
		
		echo "mysql:host=".DB_HOST.";dbname=".DB_DATABASE.", ".DB_USER.", ".DB_PASSWORD." \n\n";
		$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_DATABASE, DB_USER, DB_PASSWORD);
		$result = $pdo->query("SELECT id, userName, isDone FROM auction_filter_adv");
		while (list($id, $name, $salary) = $result->fetch(PDO::FETCH_NUM)) {
			echo " <tr>\n" .
					"  <td><a href=\"info.php?id=$id\">$name</a></td>\n" .
					"  <td>$salary</td>\n" .
					" </tr>\n";
		}

		echo "TEST****************** \n\n";
		$result = $pdo->query("SELECT id, userName, isDone FROM auction_filter_adv");
		while ($filter1 = $result->fetch(PDO::FETCH_NUM)) {
			print_r($filter1);
			list($id, $user, $isDone ) = $filter1;
			echo " <tr>\n" .
					"  <td><a href=\"info.php?id=$id\">$user</a></td>\n" .
					"  <td>$isDone</td>\n" .
					" </tr>\n";
		}
		
	}
	//$output=array();
 
/*	$q=mysql_query("SELECT * FROM auction_filter_adv WHERE id='".$_REQUEST['id']."'");
	while($e=mysql_fetch_assoc($q)) {
	        $output[]=$e;
		echo "id=".$e['id'];
	} 
	print(json_encode($output));

	$export = json_encode($output); 
	$import = json_decode($export);

	echo $_REQUEST['second'];
	print_r($import);

	 
	mysql_close();
	*/
	
	$lause = date("Y-m-d H:i:s")."----->index.php lopp \n\n\n";
	fwrite($fp, $lause);
	fclose($fp);
	
?>

</body>
</html>
