<!DOCTYPE html>
<html>
        <head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

				<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>

    <style type="text/css">
	    #report1 { font-family:Arial, Helvetica, Sans-Serif; font-size:0.8em;}
	    #report1 tr.odd:hover td:hover th {font-size:1.0em; background:#7cb8e2 cursor:pointer; color:red}
	    #report2 { font-family:Arial, Helvetica, Sans-Serif; font-size:0.9em;}
	    #report2 th { font-family:Arial, Helvetica, Sans-Serif; font-size:1.1em;}
	    #report2 tr.odd:hover td:hover th {font-size:1.0em; background:#7cb8e2 cursor:pointer; color:red}

        //body { font-family:Arial, Helvetica, Sans-Serif; font-size:1.8em;}
        //#report { border-collapse:collapse;}
        #report h4 { margin:0px; padding:0px;}
        #report img { float:right;}
        #report ul { margin:10px 0 10px 40px; padding:0px;}
        #report th { background:#7CB8E2 url(<?=base_url()?>images/header_bkg.png) repeat-x scroll center left; color:#fff; padding:7px 5px 2px 2px; text-align:left;}
        #report td { background:#C7DDEE none repeat-x scroll center left; color:#000; padding:7px 15px; }
        #report tr.odd td {font-size:0.7em; background:#fff url(<?=base_url()?>images/row_bkg.png) repeat-x scroll center left; cursor:pointer;}
        #report div.arrow { background:transparent url(<?=base_url()?>images/arrows.png) no-repeat scroll 0px -16px; width:16px; height:16px; display:block;}
        #report div.up { background-position:0px 0px;}
        #report tr.odd:hover td:hover {font-size:0.8em; background:#7cb8e2 cursor:pointer; color:red}
	    .red{ font-family:Arial, Helvetica, Sans-Serif; font-size:1.0em; color:red;}
	    .green{ font-family:Arial, Helvetica, Sans-Serif; font-size:1.0em; color:lime;}
	    .yellow{ font-family:Arial, Helvetica, Sans-Serif; font-size:1.0em; color:fuchsia;}
	    #red{ font-family:Arial, Helvetica, Sans-Serif; font-size:1.0em; color:red;}
	    #green{ font-family:Arial, Helvetica, Sans-Serif; font-size:1.0em; color:lime;}
	    #yellow{ font-family:Arial, Helvetica, Sans-Serif; font-size:1.0em; color:fuchsia;}

		body { padding-top: 50px; }
		body { padding-bottom: 570px; }
    </style>
    
     <title>Bondoora API - Login Form</title>
     <!--link the bootstrap css file   -->
     <link href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Optional theme -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

        </head>
        <body>

    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="<?=base_url()?>js/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script type='text/javascript' src='<?=base_url()?>js/jquery.tablefilter.js'></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?=base_url()?>bootstrap/js/bootstrap.min.js"></script>

<style   type="text/css">
ul.rep1 {
    margin: 0;
    padding: 0;
    background-color: #f3f3f3;
    color: red;
    font-size:1.2em;
}

li.rep1 {
    float: left;
    border-right:1px solid #bbb;
}

li.rep1:last-child {
    border-right: none;
}

li.rep1 a {
    display: block;
    background-color: gray;
    color: #666;

    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}


li a {
	color: white;
    background-color: #ddd;
}

#rep1 li a:hover {
	color: white;
    background-color: #aaa;
}

#rep1 .nav > li > a:hover,
#rep1 .nav > li > a:focus {
  text-decoration: none;
  background-color: #eee;
} 

.nav .nav-divider {
  height: 1px;
  margin: 9px 0;
  overflow: hidden;
  background-color: #e5e5e5;
} 

li.rep1 a.active {
	color: white;
    background-color: #777afd;
}


li.rep1 a:visited:not(.active) {
    color: white;
    }

li.rep1 a:visited:hover:not(.active) {
    color: red;
    }

li a:visited:not(.active) {
    color: blue;

    }

li.rep2 a.rep2:visited:not(.active) {
    color: lightblue;

    }

li.rep2  {
    color: red;

    }

li a:hover:not(.active) {
    background-color: #ddd;
    color: red;
    }

.nav {
  margin-bottom: 0;
  padding-left: 0;
  list-style: none;
}
.nav > li {
  position: relative;
  display: block;
}
.nav > li > a {
  position: relative;
  display: block;
  padding: 10px 15px;
}
.nav > li > a:hover,
.nav > li > a:focus {
  text-decoration: none;
  background-color: #eeeeee;
}
.nav > li.disabled > a {
  color: #999999;
}
.nav > li.disabled > a:hover,
.nav > li.disabled > a:focus {
  color: #999999;
  text-decoration: none;
  background-color: transparent;
  cursor: not-allowed;
}
.nav .open > a,
.nav .open > a:hover,
.nav .open > a:focus {
  background-color: #eeeeee;
  border-color: #2fa4e7;
}
.nav .nav-divider {
  height: 1px;
  margin: 9px 0;
  overflow: hidden;
  background-color: #e5e5e5;
}
.nav > li > a > img {
  max-width: none;
}
.nav-tabs {
  border-bottom: 1px solid #dddddd;
}
.nav-tabs > li {
  float: left;
  margin-bottom: -1px;
}
.nav-tabs > li > a {
  margin-right: 2px;
  line-height: 1.42857143;
  border: 1px solid transparent;
  border-radius: 4px 4px 0 0;
}
.nav-tabs > li > a:hover {
  border-color: #eeeeee #eeeeee #dddddd;
}
.nav-tabs > li.active > a,
.nav-tabs > li.active > a:hover,
.nav-tabs > li.active > a:focus {
  color: #555555;
  background-color: #ffffff;
  border: 1px solid #dddddd;
  border-bottom-color: transparent;
  cursor: default;
}
.nav-tabs.nav-justified {
  width: 100%;
  border-bottom: 0;
}
.nav-tabs.nav-justified > li {
  float: none;
}
.nav-tabs.nav-justified > li > a {
  text-align: center;
  margin-bottom: 5px;
}
.nav-tabs.nav-justified > .dropdown .dropdown-menu {
  top: auto;
  left: auto;

}


.nav-pills > li {
  float: left;
}
.nav-pills > li > a {
  border-radius: 4px;
}
.nav-pills > li + li {
  margin-left: 2px;
}
.nav-pills > li.active > a,
.nav-pills > li.active > a:hover,
.nav-pills > li.active > a:focus {
  color: #ffffff;
  background-color: #2fa4e7;
} 
  .nav-tabs-justified {
  border-bottom: 0;
}
.nav-tabs-justified > li > a {
  margin-right: 0;
  border-radius: 4px;
}
.nav-tabs-justified > .active > a,
.nav-tabs-justified > .active > a:hover,
.nav-tabs-justified > .active > a:focus {
  border: 1px solid #dddddd;
}   

 </style>
<script type="text/javascript" class="init">
//	function toggleColumn(colPos){
//	    $('#report tr').each(function(idx,item){
//		    console.log("ee");
//	        $($(item).find('td').get(colPos-1)).toggle();
//	    });
//	}
//toggleColumn(2);
</script>


<script>
//    $(function() {
//       $('#hide').click(function() {
//                $('td:nth-child(4)').hide();
//                $('th:nth-child(4)').hide();                
//       });

//	   $('#show').click(function() {
//                $('td:nth-child(4)').show();  
//                $('th:nth-child(4)').show();              
//       });
//	   $('#toggle').click(function() {
//                $('td:nth-child(4)').toggle();
//                $('th:nth-child(4)').toggle();                
//       });
//  });
  

    </script>

<script type="text/javascript">
$(document).ready(function(){
    $("#report tr:odd").addClass("odd");
    $("#report tr:not(.odd)").hide();
    $("#report tr:first-child").show();
    //console.log("test");
    $("#report tr.odd").click(function(){
        if (event.target.type !== 'checkbox') {
	        $(this).next("tr").toggle();
    	    $(this).find(".arrow").toggleClass("up");
        }
    });
    //$("#report").jExpand();
});

//function toggleRow() {
//    var row = document.getElementsByClassName("parentRow")[0];
//    var next = row.parentNode.rows[ row.rowIndex ];
//    next.style.display = next.style.display == "none" ? "table-row" : "none";
//}
function toggleRow1(e){
    var subRow = e.parentNode.parentNode.nextElementSibling;
    subRow.style.display = subRow.style.display === 'none' ? 'table-row' : 'none';    
}
function toggleRow2() {
    var rows = document.getElementsByClassName("subRow").nextSibling;
    rows.style.display = rows.style.display == "none" ? "table-row" : "none";
}
function toggleR(id) {
	var row=document.getElementId(id);
	if (row.style.dislpay == 'table-row') {
		row.style.display = 'none';
	} else {
		row.style.display = 'table-row';
	}
}
function hideRow(id) {
	var row = document.getElementById(id);
	row.style.display='none';
}
function showRow(id) {
	var row = document.getElementById(id);
	row.style.display='table-row';
}
function toggle() {
	 if( document.getElementById("hidethis").style.display=='none' ){
	   document.getElementById("hidethis").style.display = 'table-row';
	 }else{
	   document.getElementById("hidethis").style.display = 'none';
	 }
	}
function hideShow(el_id){
    var el=document.getElementById(el_id);
    console.log("element="+el_id);
    if(el.style.display!="none"){
      el.style.display="none";
    }else{
      el.style.display='table-row';
    }
  }
function ChangeColor(tableRow, highLight)
{
if (highLight)
{
  tableRow.style.backgroundColor = '#dcfac9';
}
else
{
  tableRow.style.backgroundColor = 'white';
}
}
$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	})
</script>

     
     <style type="text/css">
     .colbox {
          margin-left: 0px;
          margin-right: 0px;
     }
     </style>
                
 <?php 
 	$user_data=$this->session->userdata('login');
 	if (!$this->session->has_userdata('bondora')) {
 		$provider=NULL;
 		$token_obj=NULL;

 		if ($this->session->userdata('user_provider')) {
 			$provider = $this->session->userdata('user_povider');
 			//echo "leidsin olemasoleva provideri";
 		} else {
 			$provider = $this->oauth2->providerB("Bondoora");
 			//echo "provider leitud";
 		}
 		if (isset($token) && $token == NULL)
 			if ($this->session->has_userdata('user_session')) {
 				$token = $this->session->userdata('user_session');
 			} else redirect('auth/session/bondoora');
 				
 		if (!isset($token)) {
 			//if (!$this->session->userdata('user_session')) {
 				//redirect('auth/session/bondoora');
 			//}
 		} else //{
 			$balance = $provider->get_balance($token, $this->session);
 			 	
 	}
 	$isAdmin=$user_data['isAdmin']==1?true:false;
 ?>
 	<script type="text/javascript">
        $(document).ready(function(){
            $('#seis').popover({
                title: '<h4><span class="glyphicon glyphicon-hand-right"></span>Pealkirja all Rahaline seis</h4>',
                content: '<ul><li>Näed vaid peale rakenduse Bondoorasse sisse logimist</li><li>Andmeid uuendatakse iga 30min järel</li><li>Koosneb: Kokku raha / vaba raha / Tehtud pakkumised</li></ul>',
                html: true,
                container: 'body',
                placement: 'right',
                trigger: 'hover'
            });
        });
    </script>
 
<?php if ($title!='') { ?>
<strong>
<?php 
$seis=$this->session->has_userdata('bondora')?"(Seis: ".$this->session->userdata('bondora')->Balance."EUR / Vaba raha: ".$this->session->userdata('bondora')->TotalAvailable."EUR / Panustatud: ".$this->session->userdata('bondora')->BidRequestAmount."EUR)":"";
if ($this->session->has_userdata('bondora_new')) {
	$seis=$seis." (uuendatud)";
	$this->session->unset_userdata('bondora_new');
}
 	//}
?>
</strong>
<div class="container">
     <div class="row">
          <div class="col-lg-6 col-sm-6">
               <h3  id="seis" data-toggle="popover"><?php echo $title?> - <?php echo $user_data['fname']?> <?php echo $user_data['lname'];?></h3>
               <?php if (isset($seis)) echo $seis; else $balance = $provider->get_balance($token, $this->session);?>
          </div>
     </div>
</div>
<?php if ($isAdmin)  { ?>
	<button type="submit" class="btn btn-default" style="margin-top:5px"><a id="rep2" href="<?php echo site_url('user/truncate');?>">Tühjenda tabelid</a></button>
<?php } ?>
<hr/>
<?php } ?>
