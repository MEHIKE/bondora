<div id="show_table">
<?php 
foreach ($investments as $investment):
if ($riik1=='' || ($riik1!='' && $riik1==strtoupper($investment['country']))) {
	//echo "riik=".$riik1;
} else {
	//echo "valitud riik=".$riik1."   tegelik=".$investment['country']."<br>";
	continue;
}
if ($stat1=='' || ($stat1!='' && $stat1==strtoupper($investment['loanStatusCode'])) || ($stat1==-1 && $investment['loanStatusCode']!=4 && $investment['loanStatusCode']!=8) ) {
	//echo "riik=".$riik1;
} else {
	//echo "valitud riik=".$riik1."   tegelik=".$investment['country']."<br>";
	continue;
}
if ($contr1=='' || ($contr1!='' && $contr1==strtoupper($investment['incomeVerificationStatus']))) {
	//echo "riik=".$riik1;
} else {
	//echo "valitud riik=".$riik1."   tegelik=".$investment['country']."<br>";
	continue;
}
if ($score1=='' || ($score1!='' && $score1==strtoupper($investment['creditScore']))) {
	//echo "riik=".$riik1;
} else {
	//echo "valitud riik=".$riik1."   tegelik=".$investment['country']."<br>";
	continue;
}
if ($pik1=='' || ($pik1!='' && $pik1==($investment['loanDuration']))) {
	//echo "riik=".$riik1;
} else {
	//echo "valitud riik=".$riik1."   tegelik=".$investment['country']."<br>";
	continue;
}
$investments1[]=$investment;
endforeach;
$count=count($investments1);
$msg=': '.$count.'tk!';

?>
	<script type="text/javascript">
        $(document).ready(function(){
            $('#avainvest').popover({
                title: '<h4><span class="glyphicon glyphicon-hand-right"></span>Minu tehtud investeeringud</h4>',
                content: '<ul><li>Näed kõiki välju</li><li>Avaneb klickimisel</li><li>Sulgub klickimisel</li></ul>',
                html: true,
                container: 'body',
                placement: 'left',
                trigger: 'hover'
            });
        });
    </script>

	<script type="text/javascript">
        $(document).ready(function(){
            $('#avalaen').popover({
                title: '<h4><span class="glyphicon glyphicon-hand-right"></span>Laenuküsimise andmed</h4>',
                content: '<ul><li>Näed kõiki välju</li><li>Avaneb eraldi aknas</li><li>Millegipärast iga laenu ei leita Bondoorast</li></ul>',
                html: true,
                container: 'body',
                placement: 'left',
                trigger: 'hover'
            });
        });
    </script>

	<script type="text/javascript">
        $(document).ready(function(){
            $('#katkesta').popover({
                title: '<h4><span class="glyphicon glyphicon-hand-right"></span>Katkesta oma Järelturumüük</h4>',
                content: '<ul><li>Saad lõpetada järelturu müügi</li><li>Avaneb eraldi aknas</li><li>Toimub kohe klickimisel</li></ul>',
                html: true,
                container: 'body',
                placement: 'left',
                trigger: 'hover'
            });
        });
    </script>

	<script type="text/javascript">
        $(document).ready(function(){
            $('#laenuosa').popover({
                title: '<h4><span class="glyphicon glyphicon-hand-right"></span>Laenuosa üksikasjalikud andmed</h4>',
                content: '<ul><li>Näed kõiki välju</li><li>Avaneb eraldi aknas</li><li>All saad avada lisaandmeid</li></ul>',
                html: true,
                container: 'body',
                placement: 'left',
                trigger: 'hover'
            });
        });
    </script>

	<script type="text/javascript">
        $(document).ready(function(){
            $('#ava').popover({
                title: '<h4><span class="glyphicon glyphicon-hand-right"></span>Ava</h4>',
                content: '<ul><li>Avanevad ivesteeringu andmed</li><li>Näed kõiki välju</li><li>Laenu andmed eraldi aknas</li><li>All saad avada lisaandmeid</li></ul>',
                html: true,
                container: 'body',
                placement: 'left',
                trigger: 'hover'
            });
        });
    </script>

	<script type="text/javascript">
        $(document).ready(function(){
            $('#turul').popover({
                title: '<h4><span class="glyphicon glyphicon-hand-right"></span>Kas oled andnud järelturule müüki?</h4>',
                content: '<ul><li>Näed millal müüki panid</li><li>Näed millise allahindlusprotsendiga</li><li>Lingil klickides saad avada lisaandmed eraldi aknas</li><li>Paremal lingil saad oma müügi katkestada</li></ul>',
                html: true,
                container: 'body',
                placement: 'left',
                trigger: 'hover'
            });
        });
    </script>

 	<script type="text/javascript">
        $(document).ready(function(){
            $('#panemyyki').popover({
                title: '<h4><span class="glyphicon glyphicon-hand-right"></span>Oma investeeringute müük</h4>',
                content: '<ul><li>Saadetakse kõik märgitud Bondoorasse müüki</li><li>Oma allahindlus % saad kõrval muuta</li><li>Antakse eraldi aknas teada kas õnnestus</li></ul>',
                html: true,
                container: 'body',
                placement: 'right',
                trigger: 'hover'
            });
        });
    </script>
    
     	<script type="text/javascript">
        $(document).ready(function(){
            $('#action').popover({
                title: '<h4><span class="glyphicon glyphicon-hand-right"></span>Laenu andmete vaatamine</h4>',
                content: '<ul><li>Avaneb otse Bondooras</li><li>Konkreetse laenu andmed</li></ul>',
                html: true,
                container: 'body',
                placement: 'left',
                trigger: 'hover'
            });
        });
    </script>

       <?php 
       $current_url=current_url();
       get_instance()->session->set_userdata('current_url', $current_url);
        
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
                );
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
               <?php
        	$loanStatusCode = array(
        		  '0' => 'APIS TEADMATA',
                  '2' => 'Tavaline laen',
                  '100' => 'Viivises',
        		  '5' => '60+ viivises',
        		  '4' => 'Tagasi makstud',
        		  '8' => 'released',
        		  '3' => 'MUU',
                );
        ?>
        
        <?php
        $loanDebtManagementStage = array(
        '1' => 'Message',
        '2' => 'SentToBailiff',
        '7' => 'ExpeditedPaymentOrderIssued',
        '9' => 'DebtFullyPaid',
        '14' => 'SentToDebtRegistry',
        '15' => 'DebtNotificationEmailSent',
        '16' => 'LoanDefaulted',
        '20' => 'DecisionMadeAndDeclared',
        '22' => 'DeceasedCustomer',
        '23' => 'CallMade',
        '24' => 'DebtNotificationSmsSent',
        '' => 'POLE',
        'NULL' => 'NULL-POLE',
        );
        ?>
        
    <?php $attributes = array("method" => "post", "class" => "form-horizontal", "id" => "investmentsform", "name" => "investmentsform", "width" => 200);?>
    <?php echo form_open('investments/button', $attributes); ?>       
    <?php //$attributes = array("class" => "form-horizontal", "id" => "auctionform", "name" => "auctionform", "width" => 200);?>
    <?php //echo form_open('auctions/makebids', $attributes); ?>
    
<?php //<button type="submit" name="submit" value="formAuctions"> ?>
<?php //echo anchor('auctions/download/'.$filter,"Bondoorast uued laenu kļæ½simised");?>
<?php //</button> ?>

<nav class="navbar navbar-default navbar-fixed-top">
<div class="navbar-collapse collapse">
<ul id="rep1" class="nav navbar-nav">
  <li id="rep1" role="presentation"><a href="<?php echo site_url('auctions/index')?>">Laenuküsimised</a></li>
  <li id="rep1" role="presentation" class="active"><a class="active" href="<?php echo site_url('investments/download')?>">Bondoorast investeeringud</a></li>
  <li id="rep1" role="presentation"><a href="<?php echo site_url('secondary/index')?>">Järelturg</a></li>
  <li id="rep1" role="presentation"><a href="<?php echo site_url('bids/index')?>">Minu investeerimispakkumised</a></li>
  <!-- li id="rep1" role="presentation"><a href="--><?php //echo site_url('filters/index')?><!-- ">Filtrid</a></li-->
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
                    <li id="rep2" class="<?php echo ($this->session->userdata('signpage'))?'':'active1'?>"><a id="rep2" href="<?php echo site_url('user/login/');?>"><?php echo $login_btn?></a></li>
                    <li id="rep2" class="<?php echo ($this->session->userdata('signpage') && $this->session->userdata('signpage')==1)?'active1':''?>"><a href="<?php echo site_url('user/register/');?>">Signup</a></li>
               </ul>

</div>
</nav>


</form>
        
    <?php if($this->session->flashdata('msg')) { ?>
	<div class="alert alert-success alert-dismissible text-center" role="alert">
		<?php echo "<strong>Teade:</strong> ".$this->session->flashdata('msg').$msg; ?>
	</div><br><?php } ?>
        
    <?php if($this->session->flashdata('err')) { ?>
	<div class="alert alert-danger alert-dismissible text-center" role="alert">
		<?php echo "<strong>Viga:</strong> ".$this->session->flashdata('err'); ?>
	</div><br><?php } ?>
 

    <?php $attributes = array("method" => "post", "class" => "form-horizontal", "id" => "investmentsFilterform", "name" => "investmentsFilterform");?>
    <?php echo form_open('investments/index', $attributes); ?>   

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
        
        	$stat = array(
                  '' => 'Kõik',
                  '2' => 'Tavaline',
                  '5' => '60+viivis',
        		  '100' => 'Viivises',
        		  '4' => 'Tagasi makstud',
        		  '8' => 'Vabastatud',
        		  '-1' => 'Ainult aktiivsed',
        	);
        ?>
        <label for="stat">Laenu staatus:</label>
        <?php echo form_dropdown('stat', $stat, set_value('stat',$stat), 'style=width: 240px; font-size: 13px'); ?>

       <?php
        	$contr = array(
                  '' => 'Kõik',
                  '1' => 'Pole kontrollitud',
        		   '2' => 'Tel. teel',
                  '3' => 'Dokumendiga',
        		  '4' => 'Pangadokumendiga',
                );
        ?>
        <label for="contr">Kontrollitud:</label>
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


     <?php $attributes = array("method" => "post", "class" => "form-horizontal", "id" => "investmentsform", "name" => "investmentsform");?>
    <?php echo form_open('investments/button', $attributes); ?>   
<?php /*    
<button name="submitForm" id="formAuctions" value="formAuctions">Laenukļæ½simised</button>
<button name="submitForm" value="formInvestments">Bondoorast investeeringud</button>
<button name="submitForm" value="formToSecond">Jļæ½relturg</button>
<button name="submitForm" value="formBids">Minu investeerimispakkumised</button>
<button name="submitForm" value="formFilter">Filtrid</button>
*/ 
?>

<?php //echo anchor('auctions/index', '*Laenukļæ½simised*');?> 
<?php //echo anchor('investments/download', '*Bondoorast investeeringud*');?> 
<?php //echo anchor('secondary/index', '*Jļæ½relturg*');?>
<?php //echo anchor('bids/index', '*Minu investeerimispakkumised*');?> 
<?php //echo anchor('filters/index', '*Filtrid*');?>
<button type="submit" name="submitForm" value="formSellSecond" id="panemyyki" data-toggle="popover">Pane märgitud Järelturule müüki</button>

    <label for="procent">Allahindlus:</label>
    <input type="number" style="text-align:right;"  placeholder="Allahindlusprotsent" pattern="[0-9]+([\.|,][0-9]+)?" step="1" size="10" max="100" min="-100" maxlenght="2" name="procent" id="procent" align="right" value="<?php echo set_value('procent',$procent>0?$procent:'0')?>"></input>%
<br>

<?php 
// onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();"
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


<table class="table table-striped table-bordered table-condensed table-hover" id="report1">

	<thead>
	<tr style="display: table-row; background-color: lightgray">
		<?php //<th>##</th>?>
		
		<th id="toggle">
				<?php 
				echo form_checkbox('chk', 0, set_checkbox('chk', 0, ''));
				?>
		
		#</th>
<?php //		<th>Auction ID</th> ?>
		<th>
		Ostetud->maksmata
		</th>
<?php //		<th>Auction Bid</th>?>
		<th>Jrk</th>
<?php //		<th>Loan Id</th> ?>
		<th>Intr/sum</th>
		<th>Sum</th>
		<th>Riik</th>
		<th>Reit</th>
		<th>Krediidiskoor</th>
		<th>Intress</th>
		<th>Kontroll?</th>
		<th>Sünnipäev</th>
		<th>Sugu</th>
		<th>Laenu seis</th>
		<th>Kestus</th>
		<th id="action" data-toggle="popover">AuctionID</th>
		<th id="ava" data-toggle="popover">Ava</th>
		<th id="turul" data-toggle="popover">Järelturul?</th>
	</tr>
	
	</thead>
	<tbody>
	<?php 
	$summa=0;
	$default=0;
	$viivises=0;
	$tagasi=0;
	$viivis=0;
	$makstud=0;
	$tavalaen=0;
	$ainultviivises=0;
	$idx=0;
	$PrincipalRemaining=0;
	$vvv=0;
	$kkk=0;
	foreach ($investments1 as $investment):
/*	if ($riik1=='' || ($riik1!='' && $riik1==strtoupper($investment['country']))) {
		//echo "riik=".$riik1;
	} else {
		//echo "valitud riik=".$riik1."   tegelik=".$investment['country']."<br>";
		continue;
	}
	if ($stat1=='' || ($stat1!='' && $stat1==strtoupper($investment['loanStatusCode'])) || ($stat1==-1 && $investment['loanStatusCode']!=4 && $investment['loanStatusCode']!=8) ) {
		//echo "riik=".$riik1;
	} else {
		//echo "valitud riik=".$riik1."   tegelik=".$investment['country']."<br>";
		continue;
	}
	if ($contr1=='' || ($contr1!='' && $contr1==strtoupper($investment['incomeVerificationStatus']))) {
		//echo "riik=".$riik1;
	} else {
		//echo "valitud riik=".$riik1."   tegelik=".$investment['country']."<br>";
		continue;
	}
	if ($score1=='' || ($score1!='' && $score1==strtoupper($investment['creditScore']))) {
		//echo "riik=".$riik1;
	} else {
		//echo "valitud riik=".$riik1."   tegelik=".$investment['country']."<br>";
		continue;
	}
	if ($pik1=='' || ($pik1!='' && $pik1==($investment['loanDuration']))) {
		//echo "riik=".$riik1;
	} else {
		//echo "valitud riik=".$riik1."   tegelik=".$investment['country']."<br>";
		continue;
	}
*/	
	$idx++;
	?>
						<?php 
						if ($investment['loanStatusCode']==5) { //6++ pļæ½eva viivises
							$summa=$summa+$investment['amount'];
							$default=$default+$investment['amount']-$investment['principalRepaid']-$investment['interestRepaid'];
							$vvv=$vvv+$investment['interestLateAmount'];
							$kkk=$kkk+$investment['principalLateAmount'];
						} else if ($investment['loanStatusCode']==100) {  //viivises
							$viivises=$viivises+$investment['amount']-$investment['principalRepaid']-$investment['interestRepaid'];
							$summa=$summa+$investment['amount'];
						} else if ($investment['loanStatusCode']==4)   //tagasi makstud
							$tagasi=$tagasi+$investment['principalRepaid']+$investment['interestRepaid'];
						else $summa=$summa+$investment['amount'];  //2-tavaline laen, 8-release, ļæ½lejļæ½ļæ½nud pole teada

						$viivis=$viivis+$investment['interestRepaid'];
						//$makstud=$makstud+$investment['principalRepaid'];
							
						$PrincipalRemaining=$PrincipalRemaining+$investment['principalRemaining'];
						//$kokku = $summa+$viivis+$makstud-$tagasi;
						$kokku = $summa+$makstud-$tagasi;
						if ($investment['loanStatusCode']==2) 
							$tavalaen=$tavalaen+$investment['amount'];
						if ($investment['loanStatusCode']==100)
							$ainultviivises=$ainultviivises+$investment['amount'];
									
							$col="";
							if ($investment['loanStatusCode']==5)
								$col='color="red" class="red"';
							if ($investment['loanStatusCode']==100)
								$col='color="yellow" class="yellow"';
							if ($investment['loanStatusCode']==4)
								$col='color="green" class="green"';
						?>
						<?php 
							$col1="";
							if ($investment['loanStatusCode']==5)
								$col1='id="red" name="red"';
							if ($investment['loanStatusCode']==100)
								$col1='id="yellow" name="yellow"';
							if ($investment['loanStatusCode']==4)
								$col1='id="green" name="green"';
								
						?>
	
	<tr style="cursor: pointer !important;" class="odd" <?php echo $col1;?>  onmouseover="ChangeColor(this, true);" onmouseout="ChangeColor(this, false);">
	<?php //<td><a href="#" onclick="toggleRow1(this);"><img alt="Expand row" height="20px;" src="<?=base_url() >images/arrows.png"></a></td> ?>
				<td>
				<?php 
				echo form_checkbox('id'.$investment['id'], $idx, set_checkbox('id'.$investment['id'], $idx, ''));
				?>
				<?php echo $idx?>
				
				</td>

<?php //		<td><?php echo $investment['auctionId']></td>
				if ($investment['debtOccuredOn']!=NULL)
				{
					//$noh1=date("Y-m-d");
					//$noh2=date('Y-m-d',strtotime(substr($investment['debtOccuredOn'],0,10)));
					$noh1 = time(); // or your date as well
					//$noh2 = strtotime(strtotime(substr($investment['debtOccuredOn'],0,10)));
					$noh2 = strtotime($investment['debtOccuredOn']);
					
					$noh3 = strtotime($investment['debtOccuredOnForSecondary']);
					
					$datediff = $noh1 - $noh2;
					$datediff1 = $noh1 - $noh3;
				} else 	if ($investment['debtOccuredOnForSecondary']!=NULL)
				{
					//$noh1=date("Y-m-d");
					//$noh2=date('Y-m-d',strtotime(substr($investment['debtOccuredOn'],0,10)));
					$noh1 = time(); // or your date as well
					//$noh2 = strtotime(strtotime(substr($investment['debtOccuredOn'],0,10)));
					$noh2 = strtotime($investment['debtOccuredOn']);
					
					$noh3 = strtotime($investment['debtOccuredOnForSecondary']);
					
					$datediff = $noh1 - $noh2;
					$datediff1 = $noh1 - $noh3;
				}

				$noh1 = time(); // or your date as well
				//$noh2 = strtotime(strtotime(substr($investment['debtOccuredOn'],0,10)));
				$noh4 = strtotime($investment['nextPaymentDate']);
				$datediff4 = $noh4 - $noh1;
				if ($investment['nextPaymentDate']=='') 
					$strdatediff4='';
				else 
					$strdatediff4=" (".floor($datediff4/(60*60*24))."p)";
				
				?>
<?php
				if ($investment['debtOccuredOn']!=NULL)
				{
?>
		<td><?php echo substr($investment['purchaseDate'],0,10)."->".substr($investment['debtOccuredOn'],0,10)." (".floor($datediff/(60*60*24))."päeva)".$strdatediff4;?></td>
<?php 
				} else if ($investment['debtOccuredOnForSecondary']!=NULL) {
					?>
		<td><?php echo substr($investment['purchaseDate'],0,10)."->".substr($investment['debtOccuredOnForSecondary'],0,10)." (".floor($datediff1/(60*60*24))."päeva)".$strdatediff4;?></td>

<?php 
				} else {
					?>
		<td><?php echo substr($investment['purchaseDate'],0,10)."->".substr($investment['debtOccuredOn'],0,10).$strdatediff4?></td>

<?php 
				}

				
?>

<?php //		<td><?php echo $investment['auctionBidNumber'] ></td> ?>
					<td><?php echo $investment['nextPaymentNr']."/".$investment['nrOfScheduledPayments']?></td>
<?php //		<td><?php echo $investment['loanId'] ></td>?>
		<td><?php echo $investment['interestRepaid']."/".$investment['principalRepaid']?></td>
		
		<td><?php echo $investment['amount']?></td>
		<td><?php echo $countries[strtoupper($investment['country'])]?></td>
		<td><?php echo $investment['rating'];?></td>
		<td align="left"><?php echo $creditScore[$investment['creditScore']];?></td>
		<td><?php echo $investment['interest'];?></td>
		<td><?php echo $verifycationType[$investment['incomeVerificationStatus']]?></td>
		<td><?php echo substr($investment['dateOfBirth'],0,10);?></td>
		<td><?php echo $gender[$investment['gender']];?></td>
		
		<td <?php echo $col;?>><?php echo $loanStatusCode[$investment['loanStatusCode']];?></td>
		
		<td><?php echo $investment['loanDuration'];?>kuud</td>
		<td id="action" data-toggle="popover"><?php //echo $investment['auctionId'];?>
		
		<a href=<?php echo "https://www.bondora.ee/en/Auction/Show/".$investment['auctionId'];?> target="_blank" id="action" data-toggle="popover"><?php echo $investment['auctionId'];?></a>
		</td>
		
	<td><!-- div class="arrow" id="arrow"></div>
	<a href="#ee" onclick="toggleRow1(this);"><img alt="Expand row" height="20px;" src="<?=base_url()?>images/arrows.png"></a-->
		<a href="#ee" onclick="toggleRow1(this);" class="btn-sm" id="avainvest" data-toggle="popover">
	<!-- span class="caret"-->
	<span class="glyphicon glyphicon-hand-down" aria-hidden="true" id="avainvest" data-toggle="popover"></span>
	</a>
	<?php $uri=site_url('auctions/auction/'.$investment['auctionId']);?>
	<!-- a href=<?php echo $uri;?> target="_blank"><img alt="Expand row" height="20px;" src="<?=base_url()?>images/arrows.png"></a-->
	<a href=<?php echo $uri;?> target="_blank" class="btn-sm" id="avalaen" data-toggle="popover">
	<span class="glyphicon glyphicon-folder-open" aria-hidden="true" align="left" id="avalaen" data-toggle="popover"></span>
	<!-- img alt="Expand row" height="20px;" src="<?=base_url()?>images/arrows.png"-->
	</a>
	</td>
	<?php 
	if ($investment['listedOnDate']!=NULL) {
		?><td  style="background: lightpink; font-size: 1.2em"><b><?php echo substr($investment['listedOnDate'],0,10);?><br><?php if ($investment['xirr']!='') { echo 'xirr='.$investment['xirr']."%";}?></b>
		<a href=<?php echo site_url('secondary/loanpart/'.$investment['loanPartId']);?> target="_blank" id="laenuosa" data-toggle="popover"><?php echo "D%:".$investment['desiredDiscountRate']." Loan";?></a>
		</td>
		<td  style="background: lightpink; font-size: 1em"><b>
		<a href=<?php echo site_url('investments/cancelSecondary/'.$investment['secondaryId']);?> target="_blank" id="katkesta" data-toggle="popover"><?php echo "Cancel";?></br></a>
		</td>

	<?php 
	}
	?>


	</tr>
	<tr  class="parentRow" id="hidethis2" style="display: none;" name="parentRow">
		<td colspan="16">
			<table class="table table-bordered table-striped report2" id="report2">
				<tbody>
					<tr>
						<th style="text-align: right; white-space: nowrap;" >#LoanPartId</th>
						<td><a href=<?php echo site_url('secondary/loanpart/'.$investment['loanPartId']);?> target="_blank"><?php echo $investment['loanPartId'];?></a></td>
						<th style="text-align: right; white-space: nowrap;">#Amount</th>
						<td style="white-space: nowrap;"><?php echo $investment['amount'];?></td>
						<th style="text-align: right; white-space: nowrap;">#AuctionName</th>
						<td style="white-space: nowrap;"><?php echo $investment['auctionName'];?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#AuctionId</th>
						<td style="white-space: nowrap;"><?php //echo $investment['auctionId'];?>
						<a href=<?php echo "https://www.bondora.ee/en/Auction/Show/".$investment['auctionId'];?> target="_blank"><?php echo $investment['auctionId'];?></a>
						</td>
						<th style="text-align: right; white-space: nowrap;">#AuctionNumber</th>
						<td style="white-space: nowrap;"><?php echo $investment['auctionNumber'];?></td>
						<th style="text-align: right; white-space: nowrap;">#AuctionBidNumber</th>
						<td style="white-space: nowrap;"><?php echo $investment['auctionBidNumber'];?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#Country</th>
						<td style="white-space: nowrap;"><?php echo $countries[strtoupper($investment['country'])];?></td>
						<th style="text-align: right; white-space: nowrap;">#Rating</th>
						<td style="white-space: nowrap;"><?php echo $investment['rating'];?></td>
						<th style="text-align: right; white-space: nowrap;">#CreditScore</th>
						<td style="white-space: nowrap;"><?php echo $creditScore[$investment['creditScore']];?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#Interest</th>
						<td style="white-space: nowrap;"><?php echo $investment['interest'];?></td>
						<th style="text-align: right; white-space: nowrap;">#UseOfLoan</th>
						<td style="white-space: nowrap;"><?php echo $useOfLoan[$investment['useOfLoan']];?></td>
						<th style="text-align: right; white-space: nowrap;">#IncomeVerificationStatus</th>
						<td style="white-space: nowrap;"><?php echo $verificationType[strtoupper($investment['incomeVerificationStatus'])];?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#LoanId</th>
						<td style="white-space: nowrap;"><?php echo $investment['loanId'];?></td>
						<th style="text-align: right; white-space: nowrap;">#LoanStatusCode</th>
						<td style="white-space: nowrap;" <?php echo $col;?>><?php echo $loanStatusCode[$investment['loanStatusCode']]?></td>
						<th style="text-align: right; white-space: nowrap;">#UserName</th>
						<td style="white-space: nowrap;"><?php echo $investment['userName']?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#Gender</th>
						<td style="white-space: nowrap;"><?php echo $gender[$investment['gender']]?></td>
						<th style="text-align: right; white-space: nowrap;">#DateOfBirth</th>
						<td style="white-space: nowrap;"><?php echo substr($investment['dateOfBirth'],0,10);?></td>
						<th style="text-align: right; white-space: nowrap;">#SignedDate</th>
						<td style="white-space: nowrap;"><?php //echo $investment['signedDate'];?>
						<?php echo str_replace("T"," ",substr($investment['signedDate'],0,19));?>
						</td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#DebtOccuredOn</th>
						<td style="white-space: nowrap;"><?php //echo $investment['debtOccuredOn']?>
						<?php  if ($investment['debtOccuredOn']!='') echo str_replace("T"," ",substr($investment['debtOccuredOn'],0,19));?>
						</td>
						<th style="text-align: right; white-space: nowrap;">#DebtOccuredOnForSecondary</th>
						<td style="white-space: nowrap;"><?php //echo $investment['debtOccuredOnForSecondary']?>
						<?php  if ($investment['debtOccuredOnForSecondary']!='') echo str_replace("T"," ",substr($investment['debtOccuredOnForSecondary'],0,19));?>
						</td>
						<th style="text-align: right; white-space: nowrap;">#LoanDuration</th>
						<td style="white-space: nowrap;"><?php echo $investment['loanDuration']?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#NextPaymentNr</th>
						<td style="white-space: nowrap;"><?php echo $investment['nextPaymentNr']?></td>
						<th style="text-align: right; white-space: nowrap;">#NextPaymentDate</th>
						<td style="white-space: nowrap;"><?php echo substr($investment['nextPaymentDate'],0,10);?></td>
						<th style="text-align: right; white-space: nowrap;">#NextPaymentSum</th>
						<td style="white-space: nowrap;"><?php echo $investment['nextPaymentSum']?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#NrOfScheduledPayments</th>
						<td style="white-space: nowrap;"><?php echo $investment['nrOfScheduledPayments']?></td>
						<th style="text-align: right; white-space: nowrap;">#PrincipalRepaid</th>
						<td style="white-space: nowrap;"><?php echo $investment['principalRepaid']?></td>
						<th style="text-align: right; white-space: nowrap;">#InterestRepaid</th>
						<td style="white-space: nowrap;"><?php echo $investment['interestRepaid']?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#LateAmountPaid</th>
						<td style="white-space: nowrap;"><?php echo $investment['lateAmountPaid']?></td>
						<th style="text-align: right; white-space: nowrap;">#PrincipalRemaining</th>
						<td style="white-space: nowrap;"><?php echo $investment['principalRemaining']?></td>
						<th style="text-align: right; white-space: nowrap;">#PrincipalLateAmount</th>
						<td style="white-space: nowrap;"><?php echo $investment['principalLateAmount']?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#InterestLateAmount</th>
						<td style="white-space: nowrap;"><?php echo $investment['interestLateAmount']?></td>
						<th style="text-align: right; white-space: nowrap;">#PenaltyLateAmount</th>
						<td style="white-space: nowrap;"><?php echo $investment['penaltyLateAmount']?></td>
						<th style="text-align: right; white-space: nowrap;">#LateAmountTotal</th>
						<td style="white-space: nowrap;"><?php echo $investment['lateAmountTotal']?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#PurchaseDate</th>
						<td style="white-space: nowrap;"><?php //echo $investment['purchaseDate']?>
						<?php echo str_replace("T"," ",substr($investment['purchaseDate'],0,19));?>
						
						</td>
						<th style="text-align: right; white-space: nowrap;">#SoldDate</th>
						<td style="white-space: nowrap;"><?php //echo $investment['soldDate'];?>
						<?php  if ($investment['soldDate']!='') echo str_replace("T"," ",substr($investment['soldDate'],0,19));?>
						</td>
						<th style="text-align: right; white-space: nowrap;">#PurchasePrice</th>
						<td style="white-space: nowrap;"><?php echo $investment['purchasePrice']?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#SalePrice</th>
						<td style="white-space: nowrap;"><?php echo $investment['salePrice']?></td>
						<th style="text-align: right; white-space: nowrap;">#ListedInSecondMarketOn</th>
						<td style="white-space: nowrap;"><?php //echo $investment['listedInSecondMarketOn']?>
						<?php  if ($investment['listedInSecondMarketOn']!='') echo str_replace("T"," ",substr($investment['listedInSecondMarketOn'],0,19));?>
						</td>
						<th style="text-align: right; white-space: nowrap;">#LatestDebtManagementStage</th>
						<td style="white-space: nowrap;"><?php echo $loanDebtManagementStage[$investment['latestDebtManagementStage']]?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#LatestDebtManagementDate</th>
						<td style="white-space: nowrap;"><?php echo substr($investment['latestDebtManagementDate'],0,10);?></td>
						<th style="text-align: right; white-space: nowrap;">#NoteLoanTransfersMainAmount</th>
						<td style="white-space: nowrap;"><?php echo $investment['noteLoanTransfersMainAmount']?></td>
						<th style="text-align: right; white-space: nowrap;">#NoteLoanTransfersInterestAmount</th>
						<td style="white-space: nowrap;"><?php echo $investment['noteLoanTransfersInterestAmount']?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#NoteLoanLateChargesPaid</th>
						<td style="white-space: nowrap;"><?php echo $investment['noteLoanLateChargesPaid']?></td>
						<th style="text-align: right; white-space: nowrap;">#NoteLoanTransfersEarningsAmount</th>
						<td style="white-space: nowrap;"><?php echo $investment['noteLoanTransfersEarningsAmount']?></td>
						<th style="text-align: right; white-space: nowrap;">#NoteLoanTransfersTotalRepaimentsAmount</th>
						<td style="white-space: nowrap;"><?php echo $investment['noteLoanTransfersTotalRepaimentsAmount']?></td>
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
	
		<th colspan="999">Pankrotis: <?php echo $default;?>EUR (punane) | Viivises kuni 60p: <?php echo $viivises?>EUR (lilla) | Pole vļälja läinud: <?php echo $tagasi?>EUR (roheline) | Intressid kokku: <?php echo $viivis;?>EUR</th>
	</tr>
	<tr>
	
		<th colspan="999">Oma raha: <?php echo $PrincipalRemaining+$total-$viivis?>EUR | Pļõhiosa: <?php echo $PrincipalRemaining."EUR";?> | Hetkeseis: <?php echo $PrincipalRemaining+$total."EUR";?> | Vaba raha: <?php echo $total?>EUR | Tehtud panuseid(reserveeritud): <?php echo $waiting;?>EUR</th>

	</tr>
	
	<tr>
	
		<th colspan="999">Laene: <?php echo $all['sum'];?> | Koguaeg: <?php echo $all['all_time']?>sek | Allalaadimiseks kulus: <?php echo $all['down_time']?>sek | Summa: <?php echo $summa;?></th>

	</tr>
	</tfoot>
</table>
</form>
</div>