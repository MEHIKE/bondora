<?php 
foreach ($auctions as $auction):

if ($riik1=='' || ($riik1!='' && $riik1==strtoupper($auction['country']))) {
	//echo "riik=".$riik1;
} else {
	//echo "valitud riik=".$riik1."   tegelik=".$auction['country']."<br>";
	continue;
}
if ($rat1=='' || ($rat1!='' && $rat1==strtoupper($auction['rating']))) {
	//echo "riik=".$riik1;
} else {
	//echo "valitud riik=".$riik1."   tegelik=".$investment['country']."<br>";
	continue;
}
if ($pik1=='' || ($pik1!='' && $pik1==strtoupper($auction['loanDuration']))) {
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
}
$auctions1[]=$auction;
endforeach;
$count=0;
if (isset($auctions1))
	$count=count($auctions1);
else 
	if($this->session->flashdata('msg'))
		$msg=$this->session->flashdata('msg').'<br>'.'Antud filtrile vastavaid ei leitud, näidatakse kõiki laenupakkumisi';
	else 		
		$msg='Antud filtrile vastavaid ei leitud, näidatakse kõiki laenupakkumisi';
		
?>
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
        
       $statusCode = array(
       		'' => '',
       		'0' => 'Pending',
       		'1' => 'Open',
       		'2' => 'Successful',
       		'3' => 'Failed',
       		'4' => 'Cancelled',
  '5' => 'Accepted',     );
       
              
        	$verifycationType = array(
                  '0' => 'Pole määratud',
                  '1' => 'Pole kontrollitud',
                  '2' => 'Telefoni teel',
                  '3' => 'Dokumendiga',
        		  '4' => 'Pangaväljavõttega',
                );
        ?>
		       <?php
        	$creditScore = array(
                  '500' => '500->Aktiivsed probleemid',
                  '600' => '600->kuni 6kuud tagasi',
        		  '700' => '700->6-12kuud tagasi',
        		  '800' => '800->12-24kuud tagasi',
        		  '900' => '900->24-36kuud tagasi',
        		  '1000' => '1000->Pole probleeme',
 '' => 'Pole eesti', NULL => 'Pole eesti',              );
        ?>
       <?php
        	$gender = array(
                  '2' => 'Pole teada',
                  '0' => 'Mees',
                  '1' => 'Naine',
                );
        ?>
       <?php
        	$countries = array(
                  'EE' => 'Eesti',
                  'FI' => 'Soome',
                  'ES' => 'Hispaania',
                );
        ?>
					        <?php
        	$education = array(
                  '0' => 'Pole määratud',
                  '1' => 'Algharidus',
                  '2' => 'Põhikool',
                  '3' => 'Vocational',
        		  '4' => 'Keskharidus',
        		  '5' => 'Kõrgharidus',
                );
        ?>
					       <?php
        	$employmentStatus = array(
                  '0' => 'Pole valitud',
                  '1' => 'Töötu',
        		  '2' => 'Osalise tööajaga',
        		  '3' => 'Täistööaeg',
        		  '4' => 'Iseenda tööandja',
        		  '5' => 'Entrepreneur',
        		  '6' => 'Pensionil',
                );
        ?>
					       <?php
        	$homeOwnershipType = array(
                  '0' => 'Kodutu',
                  '1' => 'Omanik',
        		  '2' => 'Elab koos vanematega',
        		  '3' => 'TenantFurnished',
        		  '4' => 'TenantUnfurnished',
        		  '5' => 'CouncilTenant',
        		  '6' => 'JointTenant',
        			'7' => 'JointOwner',
        			'8' => 'OwnerMortgage',
        			'9' => 'OwnerEncumbrance',
                );
        ?>
       <?php
        	$maritalStatus = array(
                  '0' => 'Pole valitud',
                  '1' => 'Abielu',
                  '2' => 'Kooselu',
                  '3' => 'Üksik',
        		  '4' => 'Lahutatud',
        		  '5' => 'Lesk',
                );
        ?>
       <?php
        	$occupationArea = array(
                  '0' => 'Pole valitud',
                  '1' => 'Muu',
        		  '2' => 'Mining',
        		  '3' => 'Processing',
        		  '4' => 'Energia',
        		  '5' => 'Utilities',
        		  '6' => 'Construction',
        			'7' => 'Retail',
        			'8' => 'Transport',
        			'9' => 'Hospitality',
        			'10' => 'Telecom',
        			'11' => 'Finance',
        			'12' => 'Kinnisvara',
        			'13' => 'Teadus',
        			'14' => 'Administrative',
        			'15' => 'CivilService',
        			'16' => 'Education',
        			'17' => 'Healthcare',
        			'18' => 'Kunst',
        			'19' => 'Agriculture',
                );
        ?>
       <?php
        	$useOfLoan = array(
                  '-1' => 'Pole valitud',
                  '0' => 'Laenude konsolideerimine',
                  '1' => 'Kinnisvara ost',
        		  '2' => 'Kodu renoveerimine',
        		  '3' => 'Äri',
        		  '4' => 'Õppimiseks',
        		  '5' => 'Reisimiseks',
        		  '6' => 'Liiklusvahend',
        		  '7' => 'Muu eesmärk',
        		  '8' => 'Tervis',
                );
        ?>
       <?php
        	$verificationType = array(
                  '0' => 'Pole valitud',
                  '1' => 'Pole kontrollitud',
                  '2' => 'Kontrollitud telefoni teel',
                  '3' => 'Kontrollitud dokumendiga',
        		  '4' => 'Kontrollitud pangaväljavõttega',
                );
        ?>

    <?php $attributes = array("class" => "form-horizontal", "id" => "auctionmenuform", "name" => "auctionmenuform", "width" => 200);?>
    <?php echo form_open('auctions/index', $attributes); ?>
    
<?php //<button type="submit" name="submit" value="formAuctions"> ?>
<?php //echo anchor('auctions/download/'.$filter,"Bondoorast uued laenu k�simised");?>
<?php //</button> ?>


<nav class="navbar navbar-default navbar-fixed-top">
<div class="navbar-collapse collapse">
<ul id="rep1" class="nav navbar-nav">
  <li id="rep1" class="active"><a class="active" href="<?php echo site_url('auctions/download/'.$filter)?>">Bondoorast uued laenu küsimised</a></li>
  <li id="rep1" role="presentation" ><a href="<?php echo site_url('investments/index')?>">Minu investeeringud</a></li>
  <li id="rep1"><a href="<?php echo site_url('bids/index')?>">Minu investeerimispakkumised</a></li>
  <li id="rep1"><a href="<?php echo site_url('secondary/index')?>">Järelturu kohalikud</a></li>
  <li id="rep1"><a href="<?php echo site_url('eventlog/index')?>">Minu tegevused</a></li>

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
		<?php echo '<strong>Teade:</strong> '.$this->session->flashdata('msg').": ".$count."tk."; ?>
	</div><br><?php } ?>

    <?php if(isset($msg)) { ?>
	<div class="alert alert-success alert-dismissible text-center" role="alert">
		<?php echo '<strong>Teade:</strong> '.$msg; ?>
	</div><br><?php } ?>
        
    <?php if($this->session->flashdata('err')) { ?>
	<div class="alert alert-danger alert-dismissible text-center" role="alert">
		<?php echo '<strong>Viga:</strong> '.$this->session->flashdata('err'); ?>
	</div><br><?php } ?>

    <?php $attributes = array("method" => "post", "class" => "form-horizontal", "id" => "auctionsFilterform", "name" => "auctionsFilterform");?>
    <?php echo form_open('auctions/index', $attributes); ?>   

       <?php
        	$riik = array(
                  '' => 'Kõik',
                  'EE' => 'Eesti',
                  'FI' => 'Soome',
        		   'ES' => 'Hispaania',
                );
        ?>
        <label for="riik">Riik:</label>
        <?php echo form_dropdown('riik', $riik, set_value('riik',$riik), 'style=width: 240px; font-size: 13px'); ?>
       
       <?php
        	$rat = array(
                  '' => 'Kõik',
                  'AA' => 'AA',
                  'A' => 'A',
        		  'B' => 'B',
        		  'C' => 'C',
        		  'D' => 'D',
        			'E' => 'E',
        			'F' => 'F',
        			'HR' => 'HR',
        			 
        	);
        ?>
        <label for="rat">Reiting:</label>
        <?php echo form_dropdown('rat', $rat, set_value('rat',$rat), 'style=width: 240px; font-size: 13px'); ?>

       <?php
        	$contr = array(
                  '' => 'Kõik',
                  '1' => 'Pole kontrollitud',
        		   '2' => 'Tel. teel',
                  '3' => 'Dokumendiga',
        		  '4' => 'Pangadokumendiga',
                );
        ?>
        <label for="contr">Kontollitud:</label>
        <?php echo form_dropdown('contr', $contr, set_value('contr',$contr), 'style=width: 240px; font-size: 13px'); ?>

       <?php
        	$score = array(
                  '' => 'Kõik',
       		'500' => '500->Aktiivsed probleemid',
       		'600' => '600->kuni 6kuud tagasi',
       		'700' => '700->6-12kuud tagasi',
       		'800' => '800->12-24kuud tagasi',
    	   '900' => '900->24-36kuud tagasi',
	       '1000' => '1000->Pole probleeme',
        			);
        ?>
        <label for="score">Krediidiskoor:</label>
        <?php echo form_dropdown('score', $score, set_value('score',$score), 'style=width: 240px; font-size: 13px'); ?>

       <?php
        	$pik = array(
                  '' => 'Kõik',
                  '60' => '60kuud',
                  '48' => '48kuud',
        		  '36' => '36kuud',
        		  '24' => '24kuud',
        		  '12' => '12kuud',
        			'9' => '9kuud',
        			'3' => '3kuud',
        	);
        ?>
        <label for="pik">Pikkus:</label>
        <?php echo form_dropdown('pik', $pik, set_value('pik',$pik), 'style=width: 240px; font-size: 13px'); ?>

<button type="submit" name="submitForm" value="formFilter">Aktiveeri filter</button>
</form>

<?php //siin oli ennem formi alustamine ja men��d, sai tehtud eraldi vorm �les men�� jaoks?>

    <?php $attributes = array("class" => "form-horizontal", "id" => "auctionform", "name" => "auctionform", "width" => 200);?>
    <?php echo form_open('auctions/makebids', $attributes); ?>

<button type="submit" name="submit" value="formTOBid"><?php echo anchor('auctions/makebids', "Saada investeeringupakkumised Bondoorasse");?></button>

    <label for="laenusumma">Laenusumma:</label>
    <input type="number" style="text-align:right;"  placeholder="Laenusumma" pattern="[0-9]+([\.|,][0-9]+)?" step="1" size="3" max="9999" min="5" maxlenght="4" name="laenusumma" id="laenusumma" align="right" value="<?php echo set_value('laenusumma',$laenusumma>0?$laenusumma:'5')?>"></input>
    

<?php //$attributes = array("class" => "form-horizontal", "id" => "filterform", "name" => "filterform");?>
<?php //echo form_open('bids/makebids', $attributes); ?>

<?php 
/*<span onClick="toggle();">toggle</span><br /><br />

<table border="1" id="testt" name="testt" class="testt">
<thead>
	<tr id="first" name="first">
		<th id="ageth">?</th>
	</tr>
</thead>
<tbody>
<tr onClick="toggle();" onmouseover="ChangeColor(this, true);" 
              onmouseout="ChangeColor(this, false);" >
<td onClick="toggle();">Always visible</td>
</tr>
<tr id="hidethis">
<td>Hide this</td>
</tr>
<tr>
<td>Always visible</td>
</tr>
</tbody>
</table>*/
$this->table->set_empty("Pole määratud");

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
		<th>Auction ID</th>
		<th>Laen nr.</th>
		<th name="ageth" id="ageth">Kasutaja</th>

		<th>Summa</th>
		<th>Intress</th>
		<th>Aeg</th>

		<th>Kontrollitud</th>
		<th>Reiting</th>
		<th>Krediidiskoor</th>
		<th>Vanus</th>
		<th>Sugu</th>
		<th>Riik</th>
		
		<th>Linn</th>
		<th>Bid</th>
		<th>Inv-d</th>
		<th>Ava</th>

	</tr>
	</thead>
	<tbody>
	<?php 
	$idx=0;
	if (!isset($auctions1))
		$auctions1=$auctions;
	foreach ($auctions1 as $auction):
	
	$idx++;

	?>
						<?php 
							$col="";
							if ($auction['statusCode']==3)
								$col='color="red" class="red"'; else
							if ($auction['statusCode']==4)
								$col='color="red" class="red"'; else
							if ($auction['statusCode']==0)
								$col='color="green" class="green"'; else
							if ($auction['statusCode']==1)
								$col='color="yellow" class="yellow"';
							if (!is_numeric($auction['statusCode']))
								$col='color="green" class="black"';
								
						?>
						<?php 
							$col1="";
							if ($auction['statusCode']==3)
								$col1='color="red" name="red"'; else
							if ($auction['statusCode']==4)
								$col1='color="red" name="red"'; else
							if ($auction['statusCode']==0)
								$col1='color="green" name="green"'; else
							if ($auction['statusCode']==1)
								$col1='color="yellow" name="yellow"';
							if (!is_numeric($auction['statusCode']))
								$col1='color="green" name="black"';
								
						?>
	<tr style="cursor: pointer !important;" class="odd" <?php echo $col;?>  onmouseover="ChangeColor(this, true);" onmouseout="ChangeColor(this, false);">
	<?php //<td><a href="#" onclick="toggleRow1(this);"><img alt="Expand row" height="20px;" src="<?=base_url() >images/arrows.png"></a></td> ?>
				<td <?php echo $col;?>>
				<?php 
				echo form_checkbox('id'.$auction['id'], $idx, set_checkbox('id'.$auction['id'], $idx, ''));
				?>
				<?php echo $idx?>
				
				</td>
		<td <?php echo $col;?>><a href=<?php echo "https://www.bondora.ee/en/Auction/Show/".$auction['auctionId'];?> target="_blank"><?php echo $auction['auctionId'];?></a></td>
		<td <?php echo $col;?>><?php echo $auction['loanNumber']?></td>
		<td <?php echo $col;?>><?php echo $auction['userName']?></td>

		<td <?php echo $col;?>><?php echo $auction['appliedAmount']?></td>
		<td <?php echo $col;?>><?php echo $auction['interest']."%"?></td>
		<td <?php echo $col;?>><?php echo $auction['loanDuration']."kuud";?></td>

		<td <?php echo $col;?>><?php echo $verifycationType[$auction['verificationType']]?></td>
		<td <?php echo $col;?>><?php echo $auction['rating'];?></td>
		
		<td  <?php echo $col;?> align="left"><?php echo $creditScore[$auction['creditScore']];?></td>
		<td <?php echo $col;?>><?php echo $auction['age'];?></td>
		<td <?php echo $col;?>><?php echo $gender[$auction['gender']];?></td>
		
		<td <?php echo $col;?>><?php echo $countries[$auction['country']];?></td>
		
		<td <?php echo $col;?>><?php echo $auction['city'];?></td>
		<td <?php echo $col;?>><?php echo $statusCode[$auction['statusCode']];?></td>
		<td <?php echo $col;?>><?php echo $auction['invest'];?></td>
		
		<td><!-- div class="arrow" id="arrow"></div-->
	<a href="#ee" onclick="toggleRow1(this);" class="btn-sm">
	<!-- span class="caret"-->
	<span class="glyphicon glyphicon-hand-down" aria-hidden="true"></span>
	</a>
	<?php $uri=site_url('auctions/auction/'.$auction['auctionId']);?>
	<a href=<?php echo $uri;?> target="_blank" class="btn-sm" data-toggle="tooltip" title="Some tooltip text!">
	<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
	<!-- img alt="Expand row" height="20px;" src="<?=base_url()?>images/arrows.png"-->
	</a>
	
	</td>

	</tr>
	<tr  class="parentRow" id="hidethis2" style="display: none;" name="parentRow">
		<td colspan="15">
			<table class="table table-bordered table-striped report2" id="report2">
				<tbody>
					<tr>
						<th style="text-align: right; white-space: nowrap;" >#Vanus</th>
						<td style="white-space: nowrap;"><?php echo $auction['age'];?></td>
						<th style="text-align: right; white-space: nowrap;">#ApplicationSignedHour</th>
						<td style="white-space: nowrap;"><?php echo $auction['applicationSignedHour']."h";?></td>
						<th style="text-align: right; white-space: nowrap;">#ApplicationSignedWeekday</th>
						<td style="white-space: nowrap;"><?php echo $auction['applicationSignedWeekday'];?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#AppliedAmount</th>
						<td style="white-space: nowrap;"><?php echo $auction['appliedAmount'];?></td>
						<th style="text-align: right; white-space: nowrap;">#AuctionId</th>
						<td style="white-space: nowrap;"><?php //echo $auction['auctionId'];?>
						<a href=<?php echo "https://www.bondora.ee/en/Auction/Show/".$auction['auctionId'];?> target="_blank"><?php echo $auction['auctionId'];?></a>
						</td>
						<th style="text-align: right; white-space: nowrap;">#Linn</th>
						<td style="white-space: nowrap;"><?php echo $auction['city'];?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#Country</th>
						<td style="white-space: nowrap;"><?php echo $countries[$auction['country']];?></td>
						<th style="text-align: right; white-space: nowrap;">#County</th>
						<td style="white-space: nowrap;"><?php echo $auction['county'];?></td>
						<th style="text-align: right; white-space: nowrap;">#CreditScore</th>
						<td style="white-space: nowrap;"><?php echo $creditScore[$auction['creditScore']];?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#EADRate</th>
						<td style="white-space: nowrap;"><?php echo $auction['EADRate'];?></td>
						<th style="text-align: right; white-space: nowrap;">#Education</th>
						<td style="white-space: nowrap;"><?php echo $education[$auction['education']];?></td>
						<th style="text-align: right; white-space: nowrap;">#EmploymentDurationCurrentEmployer</th>
						<td style="white-space: nowrap;"><?php echo $auction['employmentDurationCurrentEmployer'];?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#EmploymentStatus</th>
						<td style="white-space: nowrap;"><?php echo $employmentStatus[$auction['employmentStatus']];?></td>
						<th style="text-align: right; white-space: nowrap;">#ExpectedLoss</th>
						<td style="white-space: nowrap;"><?php echo $auction['expectedLoss']?></td>
						<th style="text-align: right; white-space: nowrap;">#ExpectedReturnAlpha</th>
						<td style="white-space: nowrap;"><?php echo $auction['expectedReturnAlpha']?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#Gender</th>
						<td style="white-space: nowrap;"><?php echo $gender[$auction['gender']]?></td>
						<th style="text-align: right; white-space: nowrap;">#HomeOwnershipType</th>
						<td style="white-space: nowrap;"><?php echo $homeOwnershipType[$auction['homeOwnershipType']]?></td>
						<th style="text-align: right; white-space: nowrap;">#IncomeFromChildSupport</th>
						<td style="white-space: nowrap;"><?php echo $auction['incomeFromChildSupport'];?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#IncomeFromFamilyAllowance</th>
						<td style="white-space: nowrap;"><?php echo $auction['incomeFromFamilyAllowance'];?></td>
						<th style="text-align: right; white-space: nowrap;">#IncomeFromLeavePay</th>
						<td style="white-space: nowrap;"><?php echo $auction['incomeFromLeavePay']?></td>
						<th style="text-align: right; white-space: nowrap;">#IncomeFromPension</th>
						<td style="white-space: nowrap;"><?php echo $auction['incomeFromPension']?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#IncomeFromPrincipalEmployer</th>
						<td style="white-space: nowrap;"><?php echo $auction['incomeFromPrincipalEmployer']?></td>
						<th style="text-align: right; white-space: nowrap;">#IncomeFromSocialWelfare</th>
						<td style="white-space: nowrap;"><?php echo $auction['incomeFromSocialWelfare']?></td>
						<th style="text-align: right; white-space: nowrap;">#IncomeOther</th>
						<td style="white-space: nowrap;"><?php echo $auction['incomeOther']?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#IncomeTotal</th>
						<td style="white-space: nowrap;"><?php echo $auction['incomeTotal']?></td>
						<th style="text-align: right; white-space: nowrap;">#Interest</th>
						<td style="white-space: nowrap;"><?php echo $auction['interest']."%"?></td>
						<th style="text-align: right; white-space: nowrap;">#InterestRateAlpha</th>
						<td style="white-space: nowrap;"><?php echo $auction['interestRateAlpha']?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#LanguageCode</th>
						<td style="white-space: nowrap;"><?php echo $auction['languageCode']?></td>
						<th style="text-align: right; white-space: nowrap;">#LiabilitiesTotal</th>
						<td style="white-space: nowrap;"><?php echo $auction['liabilitiesTotal']?></td>
						<th style="text-align: right; white-space: nowrap;">#ListedOnUTC</th>
						<td style="white-space: nowrap;"><?php //echo $auction['listedOnUTC']?>
						<?php  if ($auction['listedOnUTC']!='') echo str_replace("T"," ",substr($auction['listedOnUTC'],0,19));?>
						</td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#LoanApplicationStartedDate</th>
						<td style="white-space: nowrap;"><?php //echo $auction['loanApplicationStartedDate']?>
						<?php  if ($auction['loanApplicationStartedDate']!='') echo str_replace("T"," ",substr($auction['loanApplicationStartedDate'],0,19));?>
						</td>
						<th style="text-align: right; white-space: nowrap;">#LoanDuration</th>
						<td style="white-space: nowrap;"><?php echo $auction['loanDuration']."kuud"?></td>
						<th style="text-align: right; white-space: nowrap;">#LoanId</th>
						<td style="white-space: nowrap;"><?php echo $auction['loanId']?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#LoanNumber</th>
						<td style="white-space: nowrap;"><?php echo $auction['loanNumber']?></td>
						<th style="text-align: right; white-space: nowrap;">#LossGivenDefault</th>
						<td style="white-space: nowrap;"><?php echo $auction['lossGivenDefault']?></td>
						<th style="text-align: right; white-space: nowrap;">#MaritalStatus</th>
						<td style="white-space: nowrap;"><?php echo $maritalStatus[$auction['maritalStatus']];?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#MaturityFactor</th>
						<td style="white-space: nowrap;"><?php echo $auction['maturityFactor']?></td>
						<th style="text-align: right; white-space: nowrap;">#ModelVersion</th>
						<td style="white-space: nowrap;"><?php echo $auction['modelVersion']?></td>
						<th style="text-align: right; white-space: nowrap;">#MonthlyPaymentDay</th>
						<td style="white-space: nowrap;"><?php echo $auction['monthlyPaymentDay']?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#NewCreditCustomer</th>
						<td style="white-space: nowrap;"><?php echo $auction['newCreditCustomer']?></td>
						<th style="text-align: right; white-space: nowrap;">#NrOfDependants</th>
						<td style="white-space: nowrap;"><?php echo $auction['nrOfDependants']?></td>
						<th style="text-align: right; white-space: nowrap;">#OccupationArea</th>
						<td style="white-space: nowrap;"><?php echo $occupationArea[$auction['occupationArea']]?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#ProbabilityOfDefault</th>
						<td style="white-space: nowrap;"><?php echo $auction['probabilityOfDefault']?></td>
						<th style="text-align: right; white-space: nowrap;">#Rating</th>
						<td style="white-space: nowrap;"><?php echo $auction['rating']?></td>
						<th style="text-align: right; white-space: nowrap;">#ScoringDate</th>
						<td style="white-space: nowrap;"><?php echo substr($auction['scoringDate'],0,10);?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#UseOfLoan</th>
						<td style="white-space: nowrap;"><?php echo $useOfLoan[$auction['useOfLoan']]?></td>
						<th style="text-align: right; white-space: nowrap;">#UserName</th>
						<td style="white-space: nowrap;"><?php echo $auction['userName']?></td>
						<th style="text-align: right; white-space: nowrap;">#VerificationType</th>
						<td style="white-space: nowrap;"><?php echo $verificationType[$auction['verificationType']]?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#WorkExperience</th>
						<td style="white-space: nowrap;"><?php echo $auction['workExperience']?></td>
						<th style="text-align: right; white-space: nowrap;">#BidStatusCode</th>
						<td style="white-space: nowrap;"><?php echo $statusCode[$auction['statusCode']];?></td>
						<th style="text-align: right; white-space: nowrap;">#FreeCash</th>
						<td style="white-space: nowrap;"><?php echo $auction['freeCash'];?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#DebtToIncome</th>
						<td style="white-space: nowrap;"><?php echo $auction['debtToIncome'];?></td>
						<th style="text-align: right; white-space: nowrap;">#MonthlyPayment</th>
						<td style="white-space: nowrap;"><?php echo $auction['monthlyPayment'];?></td>
						<th style="text-align: right; white-space: nowrap;">#EmploymentPosition</th>
						<td style="white-space: nowrap;"><?php echo $auction['employmentPosition'];?></td>
					</tr>
			</tbody>
			</table>
		</td>
	</tr>
	<?php endforeach;
	?>
								
	</tbody>
	<tfoot>
	<tr>
		<th colspan="999">Total: <?php echo $all['sum'];?> | Koguaeg: <?php echo $all['all_time']?>sek | Allalaadimiseks kulus: <?php echo $all['down_time']?>sek</th>
	</tr>
	</tfoot>
</table>
<button type="submit" name="submit" value="formTOBid">Saada investeeringupakkumised Bondoorasse</button>    
</form>
</div>

