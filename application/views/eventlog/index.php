    <style type="text/css">
	    .red{ font-family:Arial, Helvetica, Sans-Serif; font-size:1.0em; color:red;}
	    .green{ font-family:Arial, Helvetica, Sans-Serif; font-size:1.0em; color:lime;}
	    .yellow{ font-family:Arial, Helvetica, Sans-Serif; font-size:1.0em; color:fuchsia;}
	    #red{ font-family:Arial, Helvetica, Sans-Serif; font-size:1.0em; color:red;}
	    #green{ font-family:Arial, Helvetica, Sans-Serif; font-size:1.0em; color:lime;}
	    #yellow{ font-family:Arial, Helvetica, Sans-Serif; font-size:1.0em; color:fuchsia;}

    </style>

<div id="show_table">
       <?php
       $current_url=current_url();
       get_instance()->session->set_userdata('current_url', $current_url);
        
              
        	$eventType = array(
                  '' => 'Pole määratud',
                  '1' => 'MakeBid',
                  '2' => 'CancelBid',
                  '3' => 'SmSell',
        		  '4' => 'SmBuy',
        		  '5' => 'SmCancel',
                );
        ?>

    <?php $attributes = array("class" => "form-horizontal", "id" => "eventmenuform", "name" => "eventmenuform", "width" => 200);?>
    <?php echo form_open('eventlogs/index', $attributes); ?>
    
<?php //<button type="submit" name="submit" value="formAuctions"> ?>
<?php //echo anchor('auctions/download/'.$filter,"Bondoorast uued laenu k�simised");?>
<?php //</button> ?>


<nav class="navbar navbar-default navbar-fixed-top">
<div class="navbar-collapse collapse">
<ul id="rep1" class="nav navbar-nav">
  <li id="rep1"><a href="<?php echo site_url('auctions/index')?>">Laenuküsimised</a></li>
  <li id="rep1" role="presentation" ><a href="<?php echo site_url('investments/index')?>">Minu investeeringud</a></li>
  <li id="rep1"><a href="<?php echo site_url('bids/index')?>">Minu investeerimispakkumised</a></li>
  <li id="rep1"><a href="<?php echo site_url('secondary/index')?>">Järelturu kohalikud</a></li>
  <li id="rep1" class="active"><a class="active" href="<?php echo site_url('eventlog/index')?>">Minu tegevused</a></li>

  <!-- >ul id="rep" style="float:right;list-style-type:none;">
    <li id="rep"><a style="padding: 7px 16px;" href="#about">About</a></li>
    <li id="rep"><a style="padding: 7px 16px;" href="#login">Login</a></li>
  </ul-->
  </ul>
	<!-- ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li><a href="#">Link</a></li>

      </ul-->
          	<?php 
				//$login_btn=$this->session->userdata('user')?'Logout':'Login';               
          	$login_btn=$this->session->has_userdata('login')?'Logout':'Login';
			?>
               <ul class="nav nav-pills pull-right" style="margin-top:3px">
<?php echo $this->session->has_userdata('login')?" (".$this->session->userdata('login')['fname']." ".$this->session->userdata('login')['lname'].") ":'';?>
	               <button type="submit" class="btn btn-default" style="margin-top:5px"><a id="rep2" href="<?php echo site_url('auth/refreshsession/Bondoora');?>">Refresh</a></button>
                    <li id="rep1" class="<?php echo ($this->session->userdata('signpage'))?'':''?>"><a style="color: green;" href="<?php echo site_url('user/login/');?>"><?php echo $login_btn?></a></li>
                    <li id="rep1" class="<?php echo ($this->session->userdata('signpage') && $this->session->userdata('signpage')==1)?'':''?>"><a style="color: green;" href="<?php echo site_url('user/register/');?>">Signup</a></li>
               </ul>

</div>
</nav>

</form>

    <?php if($this->session->flashdata('msg')) { ?>
	<div class="alert alert-success alert-dismissible text-center" role="alert">
		<?php echo '<strong>Teade:</strong> '.$this->session->flashdata('msg'); ?>
	</div><br><?php } ?>
        
    <?php if($this->session->flashdata('err')) { ?>
	<div class="alert alert-danger alert-dismissible text-center" role="alert">
		<?php echo '<strong>Viga:</strong> '.$this->session->flashdata('err'); ?>
	</div><br><?php } ?>

    <?php $attributes = array("method" => "post", "class" => "form-horizontal", "id" => "auctionsFilterform", "name" => "auctionsFilterform");?>
    <?php echo form_open('eventlog/index', $attributes); ?>   

       <?php
        	$type = array(
                  '' => 'Pole määratud',
                  '1' => 'MakeBid',
                  '2' => 'CancelBid',
                  '3' => 'SmSell',
        		  '4' => 'SmBuy',
        		  '5' => 'SmCancel',
                );
        ?>
        <label for="type">Tüüp:</label>
        <?php echo form_dropdown('type', $type, set_value('type',$type), 'style=width: 240px; font-size: 13px'); ?>
       
       <?php
        	if (!isset($ip)) $ip = '';
        ?>
        <label for="ip">Ip:</label>
        <?php //echo form_dropdown('ip', $ip, set_value('ip',$ip), 'style=width: 240px; font-size: 13px'); 
        ?>
	<input type="text" style="text-align:left;"  placeholder="Päringu IP" size="15" maxlenght="15" name="ip" id="ip" value="<?php echo set_value('ip')?>"></input>

        <label for="date">Date:</label>
	<input type="text" style="text-align:left;"  placeholder="2016-01-31T09:59:59" size="20" maxlenght="20" name="date" id="date" value="<?php echo set_value('date')?>"></input>

<button type="submit" name="submitForm" value="formFilter">Aktiveeri filter</button>
</form>

<?php //siin oli ennem formi alustamine ja men��d, sai tehtud eraldi vorm �les men�� jaoks?>

    <?php $attributes = array("class" => "form-horizontal", "id" => "auctionform", "name" => "auctionform", "width" => 200);?>
    <?php echo form_open('eventlog/index', $attributes); ?>

<?php 
$this->table->set_empty("Pole määratud");
//var_dump($eventlogs);
?>


<table class="table table-striped table-bordered table-condensed" id="report1">

	<thead>
	<tr style="display: table-row; background-color: lightgray">
		<?php //<th>##</th>?>
		<th id="toggle">
				<?php 
				echo form_checkbox('chk', 0, set_checkbox('chk', 0, ''));
				?>
		
		#</th>
		<th>EventDate</th>
		<th>EventType</th>
		<th>IpAddress</th>
		<th>Data</th>

	</tr>
	</thead>
	<tbody>
	<?php 
	$idx=0;
	foreach ($eventlogs as $eventlog):
	if ($type1=='' || ($type1!='' && $type1==strtoupper($eventlog->EventType))) {
		//echo "riik=".$riik1;
	} else {
		//echo "valitud type=".$type1."   tegelik=".$eventlog->EventType."<br>";
		continue;
	}
	if ($ip1=='' || ($ip1!='' && $ip1==strtoupper($eventlog->IpAddress))) {
	} else {
		continue;
	}
	/*if ($pik1=='' || ($pik1!='' && $pik1==strtoupper($auction['loanDuration']))) {
		//echo "riik=".$riik1;
	} else {
		//echo "valitud riik=".$riik1."   tegelik=".$investment['country']."<br>";
		continue;
	}
	
	if ($contr1=='' || ($contr1!='' && $contr1==strtoupper($auction['verificationType']))) {
		//echo "riik=".$riik1;
	} else {
		//echo "valitud riik=".$riik1."   tegelik=".$investment['country']."<br>";
		continue;
	}
	if ($score1=='' || ($score1!='' && $score1==strtoupper($auction['creditScore']))) {
		//echo "riik=".$riik1;
	} else {
		//echo "valitud riik=".$riik1."   tegelik=".$investment['country']."<br>";
		continue;
	}*/
	
	$idx++;
	?>

						<?php 
							$col="";
							if ($eventlog->EventType==3)
								$col='color="red" class="red"';
							if ($eventlog->EventType==4)
								$col='color="red" class="red"';
							if ($eventlog->EventType==2)
								$col='color="green" class="green"';
							if ($eventlog->EventType==1)
								$col='color="yellow" class="yellow"';
										
						?>
						<?php 
							$col1="";
							if ($eventlog->EventType==3)
								$col1='color="red" name="red"';
							if ($eventlog->EventType==4)
								$col1='color="red" name="red"';
							if ($eventlog->EventType==2)
								$col1='color="green" name="green"';
							if ($eventlog->EventType==1)
								$col1='color="yellow" name="yellow"';
										
						?>
	<tr style="cursor: pointer !important;" class="odd" <?php echo $col;?>  onmouseover="ChangeColor(this, true);" onmouseout="ChangeColor(this, false);">
	<?php //<td><a href="#" onclick="toggleRow1(this);"><img alt="Expand row" height="20px;" src="<?=base_url() >images/arrows.png"></a></td> ?>
				<td <?php echo $col;?>>
				<?php 
				//echo form_checkbox('id'.$eventlog['id'], $idx, set_checkbox('id'.$eventlog['id'], $idx, ''));
				?>
				<?php echo $idx?>
				
				</td>
		<td <?php echo $col;?>><?php echo str_replace("T"," ",substr($eventlog->EventDate,0,19))?></td>
		<td <?php echo $col;?>><?php echo $eventType[$eventlog->EventType]?></td>

		<td <?php echo $col;?>><?php echo $eventlog->IpAddress?></td>
		<td <?php echo $col;?>><?php echo $eventlog->Data?></td>
		
	</tr>
	<?php endforeach;
	?>
								
	</tbody>
	<tfoot>
	<tr>
		<th colspan="999">Total: <?php echo $idx;?></th>
	</tr>
	</tfoot>
</table>
</form>
</div>

