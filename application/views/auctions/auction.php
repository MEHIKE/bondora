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
   '5' => 'Accepted',    );

       $weekday = array(
       		'' => '-----',
       		'0' => '00000',
       		'1' => 'Esmaspäev',
       		'2' => 'Teisipäev',
       		'3' => 'Kolmapäev',
       		'4' => 'Neljapäev',
       		'5' => 'Reede',
       		'6' => 'Laupäev',
       		'7' => 'Pühapäev',
       );
        
              
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
        	$collateralType = array(
                  '0' => 'RealEstate',
                  '1' => 'Car',
                  '2' => 'PersonalGuarantee',
                  '3' => 'CompanyGuarantee',
        		  '4' => 'OtherGuarantee',
        			'5' => 'Deposit',
        			'6' => 'OtherCollateral',
        			'7' => 'Without',
        			
                );
        ?>
       <?php
        	$typeOfLiability = array(
                  '0' => 'Loan',
                  '1' => 'Lease',
                  '2' => 'CreditCard',
                  '3' => 'RevolvingCredit',
        		  '4' => 'PersonalGuaranty',
        			'5' => 'BankGuaranty',
        			'6' => 'Other',
        			'7' => 'DebtCollection',
        			'101' => 'Communication',
        			'102' => 'Tv',
        			'103' => 'Housing',
        			'104' => 'School',
        			'105' => 'OtherPayments',
        			'106' => 'Provision',
        			'107' => 'PaydayLoan',
                );
        ?>
        <?php 
        	$newCreditCustomer = array(
                  '0' => 'vähemalt 3kuud Bondoras',
                  '1' => 'Pole Bondoras ajalugu',
                );
        
        ?>
        
    <?php if($this->session->flashdata('msg')) { ?>
	<div class="alert alert-success alert-dismissible text-center" role="alert">
		<span><strong>Teade: </strong>
		<?php echo $this->session->flashdata('msg'); ?>
	</span></div><br><?php } ?>
        
    <?php if($this->session->flashdata('err')) { ?>
	<div class="alert alert-danger alert-dismissible text-center" role="alert">
	<strong>Viga: </strong>
		<?php echo $this->session->flashdata('err'); ?>
	</div><br><?php } ?>


<?php //siin oli ennem formi alustamine ja men��d, sai tehtud eraldi vorm �les men�� jaoks?>

    <?php $attributes = array("class" => "form-horizontal", "id" => "auctionform", "name" => "auctionform", "width" => 200);?>
    <?php echo form_open('auctions/index', $attributes); ?>

  

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
$idx=0
?>


<table class="table table-hover table-striped table-bordered table-condensed" id="report1">

	<tbody>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#AuctionId</th>
						<td style="white-space: nowrap;"><?php //echo $auction['auctionId'];?>
						<a href=<?php echo "https://www.bondora.ee/en/Auction/Show/".$auction->AuctionId;?> target="_blank"><?php echo $auction->AuctionId;?></a>
						</td>
						<th style="text-align: right; white-space: nowrap;">#LoanNumber</th>
						<td style="white-space: nowrap;"><?php echo $auction->LoanNumber;?></td>
						<th style="text-align: right; white-space: nowrap;">#UserName</th>
						<td style="white-space: nowrap;"><?php echo $auction->UserName;?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;" >#LoanId</th>
						<td style="white-space: nowrap;"><?php echo $auction->LoanId;?></td>
						<th style="text-align: right; white-space: nowrap;">#LoanApplicationStartedDate</th>
						<td style="white-space: nowrap;"><?php echo str_replace("T"," ",substr($auction->LoanApplicationStartedDate,0,19));?></td>
						<th style="text-align: right; white-space: nowrap;">#VerificationType</th>
						<td style="white-space: nowrap;"><?php echo $verificationType[$auction->VerificationType];?></td>
					</tr>
					<tr>
					
						<th style="text-align: right; white-space: nowrap;">#NewCreditCustomer</th>
						<td style="white-space: nowrap;"><?php echo $newCreditCustomer[$auction->NewCreditCustomer];?></td>
						<th style="text-align: right; white-space: nowrap;">#LanguageCode</th>
						<td style="white-space: nowrap;"><?php echo $auction->LanguageCode;?></td>
						<th style="text-align: right; white-space: nowrap;">#CreditScore</th>
						<td style="white-space: nowrap;"><?php echo $creditScore[$auction->CreditScore];?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#ApplicationSignedHour</th>
						<td style="white-space: nowrap;"><?php echo $auction->ApplicationSignedHour;?></td>
						<th style="text-align: right; white-space: nowrap;">#ApplicationSignedWeekday</th>
						<td style="white-space: nowrap;"><?php echo $weekday[$auction->ApplicationSignedWeekday];?></td>
						<th style="text-align: right; white-space: nowrap;">#Age</th>
						<td style="white-space: nowrap;"><?php echo $auction->Age;?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#Gender</th>
						<td style="white-space: nowrap;"><?php echo $gender[$auction->Gender];?></td>
						<th style="text-align: right; white-space: nowrap;">#Country</th>
						<td style="white-space: nowrap;"><?php echo "".$auction->Country?></td>
						<th style="text-align: right; white-space: nowrap;">#AppliedAmount</th>
						<td style="white-space: nowrap;"><?php echo $auction->AppliedAmount?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#Interest</th>
						<td style="white-space: nowrap;"><?php echo $auction->Interest?></td>
						<th style="text-align: right; white-space: nowrap;">#LoanDuration</th>
						<td style="white-space: nowrap;"><?php echo $auction->LoanDuration?></td>
						<th style="text-align: right; white-space: nowrap;">#County</th>
						<td style="white-space: nowrap;"><?php echo $auction->County;?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#City</th>
						<td style="white-space: nowrap;"><?php echo $auction->City;?></td>
						<th style="text-align: right; white-space: nowrap;">#UseOfLoan</th>
						<td style="white-space: nowrap;"><?php echo $useOfLoan[$auction->UseOfLoan]?></td>
						<th style="text-align: right; white-space: nowrap;">#Education</th>
						<td style="white-space: nowrap;"><?php echo $education[$auction->Education]?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#MaritalStatus</th>
						<td style="white-space: nowrap;"><?php echo $maritalStatus[$auction->MaritalStatus]?></td>
						<th style="text-align: right; white-space: nowrap;">#NrOfDependants</th>
						<td style="white-space: nowrap;"><?php echo $auction->NrOfDependants?></td>
						<th style="text-align: right; white-space: nowrap;">#EmploymentStatus</th>
						<td style="white-space: nowrap;"><?php echo $employmentStatus[$auction->EmploymentStatus]?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#EmploymentDurationCurrentEmployer</th>
						<td style="white-space: nowrap;"><?php echo $auction->EmploymentDurationCurrentEmployer?></td>
						<th style="text-align: right; white-space: nowrap;">#WorkExperience</th>
						<td style="white-space: nowrap;"><?php echo $auction->WorkExperience?></td>
						<th style="text-align: right; white-space: nowrap;">#OccupationArea</th>
						<td style="white-space: nowrap;"><?php echo $occupationArea[$auction->OccupationArea]?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#HomeOwnershipType</th>
						<td style="white-space: nowrap;"><?php echo $homeOwnershipType[$auction->HomeOwnershipType]?></td>
						<th style="text-align: right; white-space: nowrap;">#IncomeFromPrincipalEmployer</th>
						<td style="white-space: nowrap;"><?php echo $auction->IncomeFromPrincipalEmployer?></td>
						<th style="text-align: right; white-space: nowrap;">#IncomeFromPension</th>
						<td style="white-space: nowrap;"><?php echo $auction->IncomeFromPension;?>
						</td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#IncomeFromFamilyAllowance</th>
						<td style="white-space: nowrap;"><?php echo $auction->IncomeFromFamilyAllowance?>
						</td>
						<th style="text-align: right; white-space: nowrap;">#IncomeFromSocialWelfare</th>
						<td style="white-space: nowrap;"><?php echo $auction->IncomeFromSocialWelfare?></td>
						<th style="text-align: right; white-space: nowrap;">#IncomeFromLeavePay</th>
						<td style="white-space: nowrap;"><?php echo $auction->IncomeFromLeavePay?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#IncomeFromChildSupport</th>
						<td style="white-space: nowrap;"><?php echo $auction->IncomeFromChildSupport?></td>
						<th style="text-align: right; white-space: nowrap;">#IncomeOther</th>
						<td style="white-space: nowrap;"><?php echo $auction->IncomeOther?></td>
						<th style="text-align: right; white-space: nowrap;">#IncomeTotal</th>
						<td style="white-space: nowrap;"><?php echo $auction->IncomeTotal;?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#MonthlyPaymentDay</th>
						<td style="white-space: nowrap;"><?php echo $auction->MonthlyPaymentDay?></td>
						<th style="text-align: right; white-space: nowrap;">#ScoringDate</th>
						<td style="white-space: nowrap;"><?php echo str_replace("T"," ",substr($auction->ScoringDate,0,19))?></td>
						<th style="text-align: right; white-space: nowrap;">#ModelVersion</th>
						<td style="white-space: nowrap;"><?php echo $auction->ModelVersion?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#ExpectedLoss</th>
						<td style="white-space: nowrap;"><?php echo $auction->ExpectedLoss?></td>
						<th style="text-align: right; white-space: nowrap;">#Rating</th>
						<td style="white-space: nowrap;"><?php echo $auction->Rating?></td>
						<th style="text-align: right; white-space: nowrap;">#EADRate</th>
						<td style="white-space: nowrap;"><?php echo $auction->EADRate?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#LossGivenDefault</th>
						<td style="white-space: nowrap;"><?php echo $auction->LossGivenDefault?></td>
						<th style="text-align: right; white-space: nowrap;">#MaturityFactor</th>
						<td style="white-space: nowrap;"><?php echo $auction->MaturityFactor?></td>
						<th style="text-align: right; white-space: nowrap;">#ProbabilityOfDefault</th>
						<td style="white-space: nowrap;"><?php echo $auction->ProbabilityOfDefault?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#ExpectedReturnAlpha</th>
						<td style="white-space: nowrap;"><?php echo $auction->ExpectedReturnAlpha?></td>
						<th style="text-align: right; white-space: nowrap;">#InterestRateAlpha</th>
						<td style="white-space: nowrap;"><?php echo $auction->InterestRateAlpha?></td>
						<th style="text-align: right; white-space: nowrap;">#LiabilitiesTotal</th>
						<td style="white-space: nowrap;"><?php echo $auction->LiabilitiesTotal?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#BorrowerHistory->Overdue</th>
						<td style="white-space: nowrap;"><?php echo $auction->BorrowerHistory->Overdue?></td>
						<th style="text-align: right; white-space: nowrap;">#BorrowerHistory->PrincipalRepaid</th>
						<td style="white-space: nowrap;"><?php echo $auction->BorrowerHistory->PrincipalRepaid?></td>
						<th style="text-align: right; white-space: nowrap;">#BorrowerHistory->InterestRepaid</th>
						<td style="white-space: nowrap;"><?php echo $auction->BorrowerHistory->InterestRepaid?></td>

					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#BorrowerHistory->LateChargesRepaid</th>
						<td style="white-space: nowrap;"><?php echo $auction->BorrowerHistory->LateChargesRepaid?></td>
						<th style="text-align: right; white-space: nowrap;">#BorrowerHistory->RepaimentsTotal</th>
						<td style="white-space: nowrap;"><?php echo $auction->BorrowerHistory->RepaimentsTotal?></td>
						<th style="text-align: right; white-space: nowrap;">#BorrowerHistory->IssuedLoans</th>
						<td style="white-space: nowrap;"><?php echo $auction->BorrowerHistory->IssuedLoans?></td>

					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#BorrowerHistory->IssuedLoanAmount</th>
						<td style="white-space: nowrap;"><?php echo $auction->BorrowerHistory->IssuedLoanAmount?></td>
						<th style="text-align: right; white-space: nowrap;">#FreeCash</th>
						<td style="white-space: nowrap;"><?php echo $auction->FreeCash?></td>
						<th style="text-align: right; white-space: nowrap;">#DebtToIncome</th>
						<td style="white-space: nowrap;"><?php echo $auction->DebtToIncome?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#MonthlyPayment</th>
						<td style="white-space: nowrap;"><?php echo $auction->MonthlyPayment?></td>
						<th style="text-align: right; white-space: nowrap;">#EmploymentPosition</th>
						<td style="white-space: nowrap;"><?php echo $auction->EmploymentPosition?></td>
					</tr>

					<tr>
						<th style="text-align: right; white-space: nowrap;">#ListedOnUTC</th>
						<td style="white-space: nowrap;"><?php echo str_replace("T"," ",substr($auction->ListedOnUTC,0,19))?></td>
						<th style="text-align: right; white-space: nowrap;">#Liabilities</th>
						<td><div class="arrow" id="arrow"></div>
							<a href="#Liabilities" onclick="toggleRow1(this);"><img alt="Expand row" height="20px;" src="<?=base_url()?>images/arrows.png"></a>
						</td>
						<th style="text-align: right; white-space: nowrap;">#Debts</th>
						<td><div class="arrow1" id="arrow1"></div>
							<a href="#Debts" onclick="hideShow('hidethis3');"><img alt="Expand row" height="20px;" src="<?=base_url()?>images/arrows.png"></a>
						</td>

					</tr>


	<tr  class="parentRow" id="hidethis2" style="display: none;" name="parentRow">
		<td colspan="15" align="center">
			<table class="table table-bordered table-striped report2" id="report2">
			<caption><strong>Debt managment event collection</strong></caption>
				<tbody>
			<tr>
						<th style="text-align: left; white-space: nowrap;" >#Jrk.</th>
						<th style="text-align: left; white-space: nowrap;" >#IsRefinanced.</th>
						<th style="text-align: left; white-space: nowrap;" >#TypeOfLiability</th>
						<th style="text-align: left; white-space: nowrap;">#Creditor</th>
						<th style="text-align: left; white-space: nowrap;">#MonthlyPayment</th>
						<th style="text-align: left; white-space: nowrap;">#Outstanding</th>
						<th style="text-align: left; white-space: nowrap;">#CollateralType</th>
			</tr>	
	<?php 
	$idx=0;
	foreach ($auction->Liabilities as $liability):
	$idx++;
	?>			
					<tr olspan="15"  onmouseover="ChangeColor(this, true);" onmouseout="ChangeColor(this, false);">
						<td style="white-space: nowrap;"><?php echo $idx;?></td>
						<td style="white-space: nowrap;"><?php echo $liability->IsRefinanced==0?'Ei':'Jah';?></td>
						<td style="white-space: nowrap;"><?php echo $typeOfLiability[$liability->TypeOfLiability];?></td>
						<td style="white-space: nowrap;"><?php echo $liability->Creditor;?></td>
						<td style="white-space: nowrap;"><?php echo $liability->MonthlyPayment;?></td>
						<td style="white-space: nowrap;"><?php echo $liability->Outstanding==''?'0.00':$liability->Outstanding;?></td>
						<td style="white-space: nowrap;"><?php echo $collateralType[$liability->CollateralType];?></td>
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
			<legend><strong>Collection of all loan payments</strong></legend>
				<tbody>
				<tr>
						<th style="text-align: left; white-space: nowrap;" >#JrkNr.</th>
						<th style="text-align: left; white-space: nowrap;" >#StartDate</th>
						<th style="text-align: left; white-space: nowrap;">#EndDate</th>
						<th style="text-align: left; white-space: nowrap;">#Amount</th>
						<th style="text-align: left; white-space: nowrap;">#MaxAmount</th>
						<th style="text-align: left; white-space: nowrap;">#Industry</th>
						<th style="text-align: left; white-space: nowrap;">#Reporter</th>
				
				</tr>
					<?php 
	$idx1=0;
	foreach ($auction->Debts as $debt):
	$idx1++;
	?>			
					<tr onmouseover="ChangeColor(this, true);" onmouseout="ChangeColor(this, false);">
						<td style="white-space: nowrap;"><?php echo $idx1;?></td>
						<td style="white-space: nowrap;"><?php //echo $loan->Date;?>
						<?php echo substr($debt->StartDate,0,10);?>
						</td>
						<td style="white-space: nowrap;"><?php echo substr($debt->EndDate);?></td>
						<td style="white-space: nowrap;"><?php echo $debt->Amount;?></td>
						<td style="white-space: nowrap;"><?php echo $debt->MaxAmount;?></td>
						<td style="white-space: nowrap;"><?php echo $debt->Industry;?></td>
						<td style="white-space: nowrap;"><?php echo $debt->Reporter;?></td>
						
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
		<th colspan="999">Auctioni sisu</th>
	</tr>
	</tfoot>
</table>
<button type="submit" name="submit" value="formTOBid">Saada investeeringupakkumised Bondoorasse</button>    
</form>
</div>

