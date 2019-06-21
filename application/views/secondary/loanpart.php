<div id="show_table">
        <head>
                <title>CodeIgniter Tutorial</title>
                <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/ex.css">
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
        tr.odd:hover td:hover {font-size:0.8em; background:#7cb8e2 cursor:pointer; color:red}

    </style>
    
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
    <script src="bootstrap/js/bootstrap.min.js"></script>
    
    <script type="text/javascript">

    function toggleR(id) {
    	var row=document.getElementId(id);
    	if (row.style.dislpay == 'table-row') {
    		row.style.display = 'none';
    	} else {
    		row.style.display = 'table-row';
    	}
    }
    
    function toggleRow2(clas) {
        var rows = document.getElementsByClassName(clas).nextSibling;
        rows.style.display = rows.style.display == "none" ? "table-row" : "none";
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

    </script>
                    
    
       <?php
       $this->load->model('secondary_model');
       $current_url=current_url();
       get_instance()->session->set_userdata('current_url', $current_url);
        
       
        	$verifycationType = array(
                  '0' => 'Pole m��ratud',
                  '1' => 'Pole kontrollitud',
                  '2' => 'Telefoni teel',
                  '3' => 'Dokumendiga',
        		  '4' => 'Pangav�ljav�ttega',
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
        	$useOfLoan = array(
                  '-1' => 'Pole valitud',
                  '0' => 'Laenude konsolideerimine',
                  '1' => 'Kinnisvara ost',
        		  '2' => 'Kodu renoveerimine',
        		  '3' => '�ri',
        		  '4' => '�ppimiseks',
        		  '5' => 'Reisimiseks',
        		  '6' => 'Liiklusvahend',
        		  '7' => 'Muu eesm�rk',
        		  '8' => 'Tervis',
                );
        ?>
       <?php
        	$verificationType = array(
                  '0' => 'Pole valitud',
                  '1' => 'Pole kontrollitud',
                  '2' => 'Kontrollitud telefoni teel',
                  '3' => 'Kontrollitud dokumendiga',
        		  '4' => 'Kontrollitud pangav�ljav�ttega',
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
        	$eventType = array(
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
        			 
                );
        ?>

<?php $this->form_validation->set_error_delimiters('<div class="error">', '</div>'); ?>
<?php echo validation_errors(); ?>
        
    <?php if($this->session->flashdata('msg')) { ?>
	<div class="alert alert-success alert dismissible text-center">
		<?php echo "Message=".$this->session->flashdata('msg'); ?>
	</div><br><?php } ?>
<?php //"accept-charset"=>"utf-8",?>
    <?php $attributes = array("accept-charset"=>"utf-8","method" => "post", "class" => "form-horizontal", "id" => "secondaryform", "name" => "secondaryform");?>
    <?php //echo 
    //form_open(base_url().'index.php/bids/secondarybuy', $attributes);
    //form_open('/bids/secondarybuy', $attributes);
    //form_open('/bids/secondarybuy', $attributes);
    ?>
<form accept-charset="utf-8" action="<?php echo site_url('secondary/index') ?>" method="post">
<?php ///bids/secondarybuy?>

<button type="submit" name="submit" value="formSecondaryDownload"><?php echo anchor('secondary/download', "Lae vastavalt filtrile uued Secondary Marketi laenud Bondoorast");?></button>
<button type="submit" name="submit" value="formSecondary"><?php echo anchor('secondary/index', "Värskeda lehte - Secondary Marketi laenud lokaalselt");?></button>


<button type="submit" name="submit" value="formBuySecondary"><?php echo anchor('bids/secondarybuy', "Saada sec.mark ost Bondoorasse");?></button>
<button type="submit" name="submit" value="formCancelSecondary">Saada katkestamine Bondoorasse(ÜKSHAAVAL)</button>

<?php 
$this->table->set_empty("Pole määratud");
?>


<table class="table table-hover table-striped table-bordered table-condensed" id="report1">

<?php //	<thead>
	//<tr style="display: table-row;">
	//	<th>Auction ID</th>
	//	<th>Vanus</th>
	//</tr>
	//</thead>
?>
	<tbody>
					<tr style="cursor: pointer !important;" class="odd" >
						<th style="text-align: right; white-space: nowrap;">#LoanPartId</th>
						<td style="white-space: nowrap;"><?php echo $loanpart->LoanPartId;?></td>
						<th style="text-align: right; white-space: nowrap;">#Amount</th>
						<td style="white-space: nowrap;"><?php echo $loanpart->Amount;?></td>
						<th style="text-align: right; white-space: nowrap;">#AuctionName</th>
						<td style="white-space: nowrap;"><?php echo $loanpart->AuctionName;?></td>
					</tr>
	
					<tr style="cursor: pointer !important;" class="odd" >
						<th style="text-align: right; white-space: nowrap;">#AuctionId</th>
						<td style="white-space: nowrap;"><a href=<?php echo "https://www.bondora.ee/en/Auction/Show/".$loanpart->AuctionId;?> target="_blank"><?php echo $loanpart->AuctionId;?></a></td>
						<th style="text-align: right; white-space: nowrap;">#AuctionNumber</th>
						<td style="white-space: nowrap;"><?php echo $loanpart->AuctionNumber;?></td>
						<th style="text-align: right; white-space: nowrap;">#AuctionBidNumber</th>
						<td style="white-space: nowrap;"><?php echo $loanpart->AuctionBidNumber;?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#Country</th>
						<td style="white-space: nowrap;"><?php echo $countries[strtoupper($loanpart->Country)];?></td>
						<th style="text-align: right; white-space: nowrap;">#Rating</th>
						<td style="white-space: nowrap;"><?php echo $loanpart->Rating;?></td>
						<th style="text-align: right; white-space: nowrap;">#CreditScore</th>
						<td style="white-space: nowrap;"><?php echo $creditScore[$loanpart->CreditScore];?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#InitialInterest</th>
						<td style="white-space: nowrap;"><?php echo $loanpart->InitialInterest;?></td>
						<th style="text-align: right; white-space: nowrap;">#Interest</th>
						<td style="white-space: nowrap;"><?php echo $loanpart->Interest;?></td>
						<th style="text-align: right; white-space: nowrap;">#UseOfLoan</th>
						<td style="white-space: nowrap;"><?php echo $useOfLoan[$loanpart->UseOfLoan]?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#LoanStatusCode</th>
						<td style="white-space: nowrap;" ><?php echo $loanStatusCode[$loanpart->LoanStatusCode]?></td>
						<th style="text-align: right; white-space: nowrap;">#IncomeVerificationStatus</th>
						<td style="white-space: nowrap;"><?php echo $verificationType[strtoupper($loanpart->IncomeVerificationStatus)];?></td>
						<th style="text-align: right; white-space: nowrap;">#Gender</th>
						<td style="white-space: nowrap;"><?php echo $gender[$loanpart->Gender]?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#LoanId</th>
						<td style="white-space: nowrap;"><?php echo $loanpart->LoanId?></td>
						<th style="text-align: right; white-space: nowrap;">#DateOfBirth</th>
						<td style="white-space: nowrap;"><?php //echo $loanpart->DateOfBirth?>
						<?php echo substr($loanpart->DateOfBirth,0,10);?>
						</td>
						<th style="text-align: right; white-space: nowrap;">#UserName</th>
						<td style="white-space: nowrap;"><?php echo $loanpart->UserName;?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#SignedDate</th>
						<td style="white-space: nowrap;"><?php //echo $loanpart->SignedDate;?>
						<?php echo str_replace("T"," ",substr($loanpart->SignedDate,0,19));?>
						</td>
						<th style="text-align: right; white-space: nowrap;">#ReScheduledOn</th>
						<td style="white-space: nowrap;"><?php //echo $loanpart->ReScheduledOn?>
						<?php echo str_replace("T"," ",substr($loanpart->ReScheduledOn,0,19));?>
						</td>
						<th style="text-align: right; white-space: nowrap;">#DebtOccuredOn</th>
						<td style="white-space: nowrap;"><?php //echo $loanpart->DebtOccuredOn?>
						<?php  if ($loanpart->DebtOccuredOn!='') echo str_replace("T"," ",substr($loanpart->DebtOccuredOn,0,19));?>
						</td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#DebtOccuredOnForSecondary</th>
						<td style="white-space: nowrap;"><?php //echo $loanpart->DebtOccuredOnForSecondary?>
						<?php  if ($loanpart->DebtOccuredOnForSecondary!='') echo str_replace("T"," ",substr($loanpart->DebtOccuredOnForSecondary,0,19));?>
						</td>
						<th style="text-align: right; white-space: nowrap;">#LoanDuration</th>
						<td style="white-space: nowrap;"><?php echo $loanpart->LoanDuration?>kuud</td>
						<th style="text-align: right; white-space: nowrap;">#NextPaymentNr</th>
						<td style="white-space: nowrap;"><?php echo $loanpart->NextPaymentNr?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#NextPaymentDate</th>
						<td style="white-space: nowrap;"><?php //echo $loanpart->NextPaymentDate?>
						<?php echo substr($loanpart->NextPaymentDate,0,10);?>
						</td>
						<th style="text-align: right; white-space: nowrap;">#NextPaymentSum</th>
						<td style="white-space: nowrap;"><?php echo $loanpart->NextPaymentSum?></td>
						<th style="text-align: right; white-space: nowrap;">#NrOfScheduledPayments</th>
						<td style="white-space: nowrap;"><?php echo $loanpart->NrOfScheduledPayments?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#LastPaymentDate</th>
						<td style="white-space: nowrap;"><?php //echo $loanpart->LastPaymentDate?>
						<?php echo substr($loanpart->LastPaymentDate,0,10);?>
						
						</td>
						<th style="text-align: right; white-space: nowrap;">#PrincipalRepaid</th>
						<td style="white-space: nowrap;"><?php echo $loanpart->PrincipalRepaid?></td>
						<th style="text-align: right; white-space: nowrap;">#InterestRepaid</th>
						<td style="white-space: nowrap;"><?php echo $loanpart->InterestRepaid?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#LateAmountPaid</th>
						<td style="white-space: nowrap;"><?php echo $loanpart->LateAmountPaid?></td>
						<th style="text-align: right; white-space: nowrap;">#PrincipalRemaining</th>
						<td style="white-space: nowrap;"><?php echo $loanpart->PrincipalRemaining?></td>
						<th style="text-align: right; white-space: nowrap;">#PrincipalLateAmount</th>
						<td style="white-space: nowrap;"><?php echo $loanpart->PrincipalLateAmount?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#InterestLateAmount</th>
						<td style="white-space: nowrap;"><?php echo $loanpart->InterestLateAmount?></td>
						<th style="text-align: right; white-space: nowrap;">#PenaltyLateAmount</th>
						<td style="white-space: nowrap;"><?php echo $loanpart->PenaltyLateAmount?></td>
						<th style="text-align: right; white-space: nowrap;">#LateAmountTotal</th>
						<td style="white-space: nowrap;"><?php echo $loanpart->LateAmountTotal?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#RepaidPrincipalCurrentOwner</th>
						<td style="white-space: nowrap;"><?php echo $loanpart->RepaidPrincipalCurrentOwner?></td>
						<th style="text-align: right; white-space: nowrap;">#RepaidInterestsCurrentOwner</th>
						<td style="white-space: nowrap;"><?php echo $loanpart->RepaidInterestsCurrentOwner?></td>
						<th style="text-align: right; white-space: nowrap;">#LateChargesPaidCurrentOwner</th>
						<td style="white-space: nowrap;"><?php echo $loanpart->LateChargesPaidCurrentOwner?></td>
					</tr>
					<tr onmouseover="ChangeColor(this, true);" onmouseout="ChangeColor(this, false);">
						<th style="text-align: right; white-space: nowrap;">#RepaidTotalCurrentOwner</th>
						<td style="white-space: nowrap;"><?php echo $loanpart->RepaidTotalCurrentOwner?></td>
						<th style="text-align: right; white-space: nowrap;">#TotalRepaid</th>
						<td style="white-space: nowrap;"><?php echo $loanpart->TotalRepaid?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#DebtManagmentEvents</th>
						<td><div class="arrow" id="arrow"></div>
							<a href="#DebtManagmentEvents" onclick="toggleRow1(this);"><img alt="Expand row" height="20px;" src="<?=base_url()?>images/arrows.png"></a>
						</td>
						<th style="text-align: right; white-space: nowrap;">#LoanTransfers</th>
						<td><div class="arrow1" id="arrow1"></div>
							<a href="#LoanTransfers" onclick="hideShow('hidethis3');"><img alt="Expand row" height="20px;" src="<?=base_url()?>images/arrows.png"></a>
						</td>
						<th style="text-align: right; white-space: nowrap;">#ScheduledPayments</th>
						<td><div class="arrow" id="arrow"></div>
							<a href="#ScheduledPayments" onclick="hideShow('hidethis4');"><img alt="Expand row" height="20px;" src="<?=base_url()?>images/arrows.png"></a>
						</td>

					</tr>
	
	<?php 
	$idx=0;
	//foreach ($secondarys as $secondary):
	$idx++;
	
	$startDate = new DateTime(substr($loanpart->SignedDate,0,10));
	$endDate =  time();
	//$interval = date_diff($startDate, $endDate);
	//echo $interval->m + ($interval->y * 12) . ' months';
	//$numberOfMonths = abs((date('Y', $endDate) - date('Y', $startDate))*12 + (date('m', $endDate) - date('m', $startDate)))+1;
	
	?>
	
	<tr  class="parentRow" id="hidethis2" style="display: none;" name="parentRow">
		<td colspan="15" align="center">
			<table class="table table-bordered table-striped report2" id="report2">
			<caption><strong>Debt managment event collection</strong></caption>
				<tbody>
			<tr>
						<th style="text-align: right; white-space: nowrap;" >#JrkNr.</th>
						<th style="text-align: right; white-space: nowrap;" >#CreatedOn</th>
						<th style="text-align: right; white-space: nowrap;">#EventType</th>
						<th style="text-align: right; white-space: nowrap;">#Description</th>
			
			</tr>	
	<?php 
	$idx=0;
	foreach ($loanpart->DebtManagmentEvents as $debt):
	$idx++;
	?>			
					<tr onmouseover="ChangeColor(this, true);" onmouseout="ChangeColor(this, false);">
						<td style="white-space: nowrap;"><?php echo $idx;?></td>
						<td style="white-space: nowrap;"><?php //echo $this->secondary_module->get_time($debt->CreatedOn);?>
						<?php echo str_replace("T"," ",substr($debt->CreatedOn,0,19));?>
						</td>
						<td style="white-space: nowrap;"><?php echo $eventType[$debt->EventType];?></td>
						<td style="white-space: nowrap;"><?php echo $debt->Description;?></td>
					</tr>
		<?php endforeach;
		?>
			</tbody>
			</table>
		</td>
	</tr>
	
	<tr  class="teine" id="hidethis3" style="display: none;" name="parentRow">
		<td colspan="15"  align="center">
			<table class="table table-bordered table-striped report2" id="report2">
			<caption><strong>Collection of all loan payments</strong></caption>
				<tbody>
				<tr>
						<th style="text-align: right; white-space: nowrap;" >#JrkNr.</th>
						<th style="text-align: right; white-space: nowrap;" >#Date</th>
						<th style="text-align: right; white-space: nowrap;">#PrincipalAmount</th>
						<th style="text-align: right; white-space: nowrap;">#InterestAmount</th>
						<th style="text-align: right; white-space: nowrap;">#InterestAmountCarriedOver</th>
						<th style="text-align: right; white-space: nowrap;">#PenaltyAmountCarriedOver</th>
						<th style="text-align: right; white-space: nowrap;">#TotalAmount</th>
				
				</tr>
					<?php 
	$idx1=0;
	foreach ($loanpart->LoanTransfers as $loan):
	$idx1++;
	?>			
					<tr onmouseover="ChangeColor(this, true);" onmouseout="ChangeColor(this, false);">
						<td style="white-space: nowrap;"><?php echo $idx1;?></td>
						<td style="white-space: nowrap;"><?php //echo $loan->Date;?>
						<?php echo substr($loan->Date,0,10);?>
						</td>
						<td style="white-space: nowrap;"><?php echo $loan->PrincipalAmount;?></td>
						<td style="white-space: nowrap;"><?php echo $loan->InterestAmount;?></td>
						<td style="white-space: nowrap;"><?php echo $loan->InterestAmountCarriedOver;?></td>
						<td style="white-space: nowrap;"><?php echo $loan->PenaltyAmountCarriedOver;?></td>
						<td style="white-space: nowrap;"><?php echo $loan->TotalAmount;?></td>
						
					</tr>
							<?php endforeach;
		?>
			</tbody>
			</table>
		</td>
	</tr>

	<tr  class="teine" id="hidethis4" style="display: none;" name="parentRow">
		<td colspan="15"   align="center">
			<table class="table table-bordered table-striped report2" id="report2">
			<caption><strong>Collection of all loan scheduled payments. Contains previous period values before rescheduling was made</strong></caption>
				<tbody>
				<tr>
						<th style="text-align: right; white-space: nowrap;" >#JrkNr.</th>
						<th style="text-align: right; white-space: nowrap;" >#ScheduledDate</th>
						<th style="text-align: right; white-space: nowrap;">#PrincipalAmount</th>
						<th style="text-align: right; white-space: nowrap;">#PrincipalAmountLeft</th>
						<th style="text-align: right; white-space: nowrap;">#InterestAmount</th>
						<th style="text-align: right; white-space: nowrap;">#IntrestAmountCarriedOver</th>
						<th style="text-align: right; white-space: nowrap;">#PenaltyAmountCarriedOver</th>
						<th style="text-align: right; white-space: nowrap;">#TotalAmount</th>										
				</tr>
									<?php 
	$idx2=0;
	foreach ($loanpart->ScheduledPayments as $payment):
	$idx2++;
	?>			
					<tr onmouseover="ChangeColor(this, true);" onmouseout="ChangeColor(this, false);">
						<td style="white-space: nowrap;"><?php echo $idx2;?></td>
						<td style="white-space: nowrap;"><?php //echo $payment->ScheduledDate;?>
						<?php echo substr($payment->ScheduledDate,0,10);?>
						</td>
						<td style="white-space: nowrap;"><?php echo $payment->PrincipalAmount;?></td>
						<td style="white-space: nowrap;"><?php echo $payment->PrincipalAmountLeft;?></td>
						<td style="white-space: nowrap;"><?php echo $payment->InterestAmount;?></td>
						<td style="white-space: nowrap;"><?php echo $payment->IntrestAmountCarriedOver;?></td>
						<td style="white-space: nowrap;"><?php echo $payment->PenaltyAmountCarriedOver;?></td>
						<td style="white-space: nowrap;"><?php echo $payment->TotalAmount;?></td>
					</tr>
	<?php endforeach;
	?>

			</tbody>
			</table>
		</td>
	</tr>
	
								
	</tbody>
	<tfoot>
	<tr>
		<th colspan="999">Laenuosa sisu</th>
	</tr>
	</tfoot>
</table>

<button type="submit" name="submit" value="formCancelSecondary">Saada katkestamine Bondoorasse(ÜKSHAAVAL)</button>
<button type="submit" name="submit" value="formBuySecondary"><?php echo anchor('bids/secondarybuy', "Saada sec.mark ost Bondoorasse");?></button>
</form>
</div>
