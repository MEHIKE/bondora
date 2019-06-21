<div id="show_table">

	<script type="text/javascript">
        $(document).ready(function(){
            $('#avasecond').popover({
                title: '<h4><span class="glyphicon glyphicon-hand-right"></span>Järelturg</h4>',
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
            $('#saadaost').popover({
                title: '<h4><span class="glyphicon glyphicon-hand-right"></span>Järelturu ostud</h4>',
                content: '<ul><li>Saadetakse kõik märgitud Bondoorasse</li><li>Antakse teada kas õnnestus</li></ul>',
                html: true,
                container: 'body',
                placement: 'right',
                trigger: 'hover'
            });
        });
    </script>
 	<script type="text/javascript">
        $(document).ready(function(){
            $('#tyhistaost').popover({
                title: '<h4><span class="glyphicon glyphicon-hand-right"></span>Järelturu müük</h4>',
                content: '<ul><li>Saadetakse üks märgitud Bondoorasse</li><li>Antakse teada kas õnnestus</li><li>Müüa saad ainult enda asju ükshaaval</li></ul>',
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
        
    <?php //$attributes = array("method" => "post", "class" => "form-horizontal", "id" => "investmentsform", "name" => "investmentsform", "width" => 200);?>
    <?php //echo form_open('investments/button', $attributes); ?>       
	<form accept-charset="utf-8" action="<?php echo site_url('secondary/index') ?>" method="post">


<nav class="navbar navbar-default navbar-fixed-top">
<div class="navbar-collapse collapse">
<ul id="rep1" class="nav navbar-nav">
  <li id="rep1" role="presentation"><a href="<?php echo site_url('auctions/index')?>">Laenuküsimised</a></li>
  <li id="rep1" role="presentation"><a href="<?php echo site_url('investments/index')?>">Minu investeeringud</a></li>
  <li id="rep1" role="presentation"><a class="active" href="<?php echo site_url('secondary/download')?>">Lae Bondoorast Järelturg</a></li>
  <li id="rep1" role="presentation" class="active"><a class="active" href="<?php echo site_url('secondary/index')?>">Refreshi leht</a></li>
  <li id="rep1" role="presentation"><a href="<?php echo site_url('bids/index')?>">Minu pakkumised, Bids</a></li>
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
                    <li id="rep2" class="<?php echo ($this->session->userdata('signpage') && $this->session->userdata('signpage')==1)?'active':'active'?>"><a href="<?php echo site_url('auth/refreshsession/Bondoora');?>">Refresh</a></li>
               </ul>

</div>
</nav>

</form>        

<?php //echo anchor('auctions/index', '*Laenu k�simised*');?>
<?php //echo anchor('investments/index', '*Minu investeeringud*');?> 
<?php //echo anchor('bids/download', '*Bondoorast minu investeerimise pakkumised, Bids*');?>

        
<?php $this->form_validation->set_error_delimiters('<div class="error">', '</div>'); ?>
<?php echo validation_errors(); ?>
        
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


<?php //"accept-charset"=>"utf-8",?>
    <?php $attributes = array("accept-charset"=>"utf-8","method" => "post", "class" => "form-horizontal", "id" => "secondaryform", "name" => "secondaryform");?>
    <?php //echo 
    //form_open(base_url().'index.php/bids/secondarybuy', $attributes);
    //form_open('/bids/secondarybuy', $attributes);
    //form_open('/bids/secondarybuy', $attributes);
    ?>
<form accept-charset="utf-8" action="<?php echo site_url('secondary/index') ?>" method="post">
<?php ///bids/secondarybuy?>

<?php //<button type="submit" name="submit" value="formSecondaryDownload"> ?>
<?php //echo anchor('secondary/download', "Lae vastavalt filtrile uued Secondary Marketi laenud Bondoorast");?>
<?php //</button>
//<button type="submit" name="submit" value="formSecondary"> ?>
<?php //echo anchor('secondary/index', "V�rskeda lehte - Secondary Marketi laenud lokaalselt");?>
<?php //</button> ?>

<?php //echo anchor('auctions/index', '*Laenu k�simised*');?>
<?php //echo anchor('investments/index', '*Minu investeeringud*');?> 
<?php //echo anchor('bids/download', '*Bondoorast minu investeerimise pakkumised, Bids*');?>


<button type="submit" name="submit" value="formBuySecondary" id="saadaost" data-toggle="popover"><?php echo anchor('bids/secondarybuy', "Saada sec.mark ost Bondoorasse");?></button>
<button type="submit" name="submit" value="formCancelSecondary" id="tyhistaost" data-toggle="popover">Saada katkestamine Bondoorasse(ÜKSHAAVAL)</button>


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

<input type="hidden" name="l_id" value="<?php echo $localfilter['id']?>"></input><br />
<input type="hidden" name="r_id" value="<?php echo $filter['id']?>"></input><br />

<table class="table table-striped table-bordered table-condensed  table-hover" id="report2">
<caption><strong>Bondoora filtrid</strong></caption>

<thead>
<tr style="display: table-row; background-color: lightgray">
		<th>showMyItems</th>
		<th>hasDebt</th>
		<th>countries</th>
		<th>AgeMax</th>
		<th>PrincipalMax</th>
		<th>CreditScoreMin</th>
		<th>InterestMin</th>
		</tr>
		<tr style="display: table-row; background-color: lightgray">
		<th>XirrMin</th>
		<th>DesiredDiscountRateMax</th>
		<th>incomeVerificationStatus</th>
		<th>lengthMax</th>
		<th>ratings</th>

	</tr>
	</thead>
	<tbody>
	<?php 
//	foreach ($payloads as $payload):
	//$idx++;
	?>
	<tr style="cursor: pointer !important;" class="odd">
	    <td><input type="text" name="showMyItems" id="showMyItems" placeholder="Tühi/true/false" value="<?php echo set_value('showMyItems',$filter['showMyItems'])?>"/>
		</td>
	    <td><input type="text" name="hasDebt" id="hasDebt" placeholder="1=Võlg/0-Pole" value="<?php echo set_value('hasDebt',$filter['hasDebt'])?>"/>
		</td>
	    <td><input type="text" name="countries" id="countries" placeholder="EE,FI,ES" value="<?php echo set_value('countries',$filter['countries'])?>"/>
		</td>
	    <td><input type="text" name="ageMax" id="ageMax" placeholder="Max vanus" value="<?php echo set_value('ageMax',$filter['ageMax'])?>"/>
		</td>
	    <td><input type="number" name="principalMax" id="principalMax" placeholder="Max laenu suurus" value="<?php echo set_value('principalMax',$filter['principalMax'])?>"/>
		</td>
	    <td><input type="text" name="creditScoreMin" id="creditScoreMin" placeholder="Krediidiskoormin 900" value="<?php echo set_value('creditScoreMin',$filter['creditScoreMin'])?>"/>
		</td>
	    <td><input type="text" name="interestMin" id="interestMin" placeholder="Minimaalne intress" value="<?php echo set_value('interestMin',$filter['interestMin'])?>"/>
		</td>
		</tr>
		<tr>
	    <td><input type="text" name="xirrMin" id="xirrMin" placeholder="Minimaalne XIRR" value="<?php echo set_value('xirrMin',$filter['xirrMin'])?>"/>
		</td>
	    <td><input type="text" name="desiredDiscountRateMax" id="desiredDiscountRateMax" placeholder="Max allahindlus" value="<?php echo set_value('desiredDiscountRateMax',$filter['desiredDiscountRateMax'])?>"/>
		</td>
	    <td><input type="text" name="incomeVerificationStatus" id="incomeVerificationStatus" placeholder="1-pole,2-tel,3-doc,4-pank" value="<?php echo set_value('incomeVerificationStatus',$filter['incomeVerificationStatus'])?>"/>
		</td>
	    <td><input type="text" name="lengthMax" id="lengthMax" placeholder="laenu pikkus, kuud" value="<?php echo set_value('lengthMax',$filter['lengthMax'])?>"/>
		</td>
	    <td><input type="text" name="ratings" id="ratings" placeholder="ratings AA,B,C,D,E,F,HR" value="<?php echo set_value('ratings',$filter['ratings'])?>"/>
		</td>

	</tr>

	<?php //endforeach;
	?>
	</tbody>
	<tfoot>
	<tr >
		<th colspan="999"><button type="submit" name="submit" value="formSecondaryFilter">Salvesta ja refreshi Bondoora filter</button>
	</th>
	</tr>
	</tfoot>
</table>

<table class="table table-striped table-bordered table-condensed table-hover" id="report2">
<caption><strong> Lokaalsed filtrid</strong></caption>
<thead>
<tr style="display: table-row; background-color: lightgray">
		<th>hasDebt</th>
		<th>hasDebtSecondary</th>
		<th>countries</th>
		<th>AgeMax</th>
		<th>PrincipalMax</th>
		<th>CreditScoreMin</th>
		<th>InterestMin</th>
		</tr>
		<tr style="display: table-row; background-color: lightgray">
		<th>XirrMin</th>
		<th>DesiredDiscountRateMax</th>
		<th>nextPaymentNrMin</th>
		<th>incomeVerificationStatus</th>
		<th>lengthMax</th>
		<th>ratings</th>
		<th>LoanStatusCode</th>

	</tr>
	</thead>
	<tbody>
	<?php 
//	foreach ($payloads as $payload):
	//$idx++;
	?>
	<tr style="cursor: pointer !important;" class="odd">
	    <td><input type="text" name="l_hasDebt" id="l_hasDebt" placeholder="1=Võlg/0-Pole" value="<?php echo set_value('l_hasDebt',$localfilter['hasDebt'])?>"/>
		</td>
	    <td><input type="text" name="l_hasDebtSecondary" id="l_hasDebtSecondary" placeholder="1=Võlg/0-Pole, Secondary" value="<?php echo set_value('l_hasDebtSecondary',$localfilter['hasDebtSecondary'])?>"/>
		</td>
	    <td><input type="text" name="l_countries" id="l_countries" placeholder="EE,FI,ES" value="<?php echo set_value('l_countries',$localfilter['countries'])?>"/>
		</td>
	    <td><input type="text" name="l_ageMax" id="l_ageMax" placeholder="Max vanus" value="<?php echo set_value('l_ageMax',$localfilter['ageMax'])?>"/>
		</td>
	    <td><input type="text" name="l_principalMax" id="l_principalMax" placeholder="Max laenu suurus" value="<?php echo set_value('l_principalMax',$localfilter['principalMax'])?>"/>
		</td>
	    <td><input type="text" name="l_creditScoreMin" id="l_creditScoreMin" placeholder="Krediidiskoormin 900" value="<?php echo set_value('l_creditScoreMin',$localfilter['creditScoreMin'])?>"/>
		</td>
	    <td><input type="text" name="l_interestMin" id="l_interestMin" placeholder="Minimaalne intress" value="<?php echo set_value('l_interestMin',$localfilter['interestMin'])?>"/>
		</td>
		</tr>
		<tr>
	    <td><input type="text" name="l_xirrMin" id="l_xirrMin" placeholder="Minimaalne XIRR" value="<?php echo set_value('l_xirrMin',$localfilter['xirrMin'])?>"/>
		</td>
	    <td><input type="text" name="l_desiredDiscountRateMax" id="l_desiredDiscountRateMax" placeholder="Max allahindlus" value="<?php echo set_value('l_desiredDiscountRateMax',$localfilter['desiredDiscountRateMax'])?>"/>
		</td>
	    <td><input type="text" name="l_nextPaymentNrMin" id="l_nextPaymentNrMin" placeholder="Min makset tehtud" value="<?php echo set_value('l_nextPaymentNrMin',$localfilter['nextPaymentNrMin'])?>"/>
		</td>
	    <td><input type="text" name="l_incomeVerificationStatus" id="l_incomeVerificationStatus" placeholder="1-pole,2-tel,3-doc,4-pank" value="<?php echo set_value('l_incomeVerificationStatus',$localfilter['incomeVerificationStatus'])?>"/>
		</td>
	    <td><input type="text" name="l_lengthMax" id="l_lengthMax" placeholder="laenu pikkus, kuud" value="<?php echo set_value('l_lengthMax',$localfilter['lengthMax'])?>"/>
		</td>
	    <td><input type="text" name="l_ratings" id="l_ratings" placeholder="ratings AA,B,C,D,E,F,HR" value="<?php echo set_value('l_ratings',$localfilter['ratings'])?>"/>
		</td>
	    <td><input type="text" name="l_loanstatus" id="l_loanstatus" placeholder="status 2cur,100over,5-60+,4repaid,8released" value="<?php echo set_value('l_loanstatus',$localfilter['loanStatusCode'])?>"/>
		</td>

	</tr>

	<?php //endforeach;
	?>
	</tbody>
	<tfoot>
	<tr >
		<th colspan="999"><button type="submit" name="submit" value="formSecondaryLocalFilter">Salvesta ja refreshi lokaalne filter</button>
	</th>
	</tr>
	</tfoot>
</table>

<table class="table table-striped table-bordered table-condensed table-hover" id="report1">

	<thead>
	<tr style="display: table-row; background-color: lightgray">
		<?php //<th>##</th>?>
		<th id="toggle">
				<?php 
				echo form_checkbox('chk', 0, set_checkbox('chk', 0, ''));
				?>
		
		#</th>
		<th>LoanPart ID</th>
		<th id="action" data-toggle="popover">Auction ID</th>
		<th>Kasutaja</th>

		<th>Maksta</th>
		<th>Alla</th>
		<th>Intress</th>
		<th>Xirr</th>

		<th>Kontrollitud</th>
		<th>Reit</th>
		<th>Krediidiskoor</th>

		<th>Sugu</th>
		<th>Riik</th>
		
<?php //		<th>Hind</th>?>
		<th>Maksenr</th>
		<th>Maksab</th>
		<th>Laenupäev</th>
		<th>Müügipäev</th>
		<th>Ava</th>
		<th>Vanus</th>

	</tr>
	</thead>
	<tbody>
	<?php 
	$idx=0;
	foreach ($secondarys as $secondary):
	$idx++;
	
	$startDate = new DateTime(substr($secondary['signedDate'],0,10));
	$endDate =  time();
	//$interval = date_diff($startDate, $endDate);
	//echo $interval->m + ($interval->y * 12) . ' months';
	//$numberOfMonths = abs((date('Y', $endDate) - date('Y', $startDate))*12 + (date('m', $endDate) - date('m', $startDate)))+1;
	
	?>
	
	<tr style="cursor: pointer !important;<?php if ($secondary['isMy']==1) echo "background-color='red'";?>" class="odd" onmouseover="ChangeColor(this, true);" onmouseout="ChangeColor(this, false);">
	<?php //<td><a href="#" onclick="toggleRow1(this);"><img alt="Expand row" height="20px;" src="<?=base_url() >images/arrows.png"></a></td> ?>
				<td>
				<?php 
				echo form_checkbox('id'.$secondary['id'], $idx, set_checkbox('id'.$secondary['id'], $idx, ''));
				?>
				<?php echo $idx?>
				
				</td>
		<td><a href=<?php echo site_url('secondary/loanpart/'.$secondary['loanPartId']);?> target="_blank"><?php echo $secondary['loanPartId'];?></a></td>

		<td id="action" data-toggle="popover"><a href=<?php echo "https://www.bondora.ee/en/Auction/Show/".$secondary['auctionId'];?> target="_blank" id="action" data-toggle="popover"><?php echo $secondary['auctionId'];?></a></td>
		<td><?php echo $secondary['userName']?></td>
		<td><?php echo $secondary['principalRemaining']?></td>
		<td><?php echo $secondary['desiredDiscountRate']."%"?></td>
		<td><?php echo $secondary['interest']."%"?></td>
		<td><?php echo $secondary['xirr']."%"?></td>
		<td><?php echo $verifycationType[$secondary['incomeVerificationStatus']]?></td>
		<td><?php echo $secondary['rating'];?></td>
		<td align="left"><?php echo $creditScore[$secondary['creditScore']];?></td>
		<td><?php echo $gender[$secondary['gender']];?></td>
		<td><?php echo $countries[strtoupper($secondary['country'])];?></td>
		
		<?php //<td><?php echo $secondary['price']; ></td>?>
		<td><?php echo $secondary['nextPaymentNr'].'/'.$secondary['nrOfScheduledPayments']."->".$secondary['months']; ?></td>
		<td><?php echo $secondary['totalCost'];?></td>
		<td><?php echo substr($secondary['signedDate'],0,10);?></td>
		<td><?php echo substr($secondary['listedOnDate'],0,10);?></td>
	<td><!-- >div class="arrow" id="arrow"></div>
	<a href="#ee" onclick="toggleRow1(this);"><img alt="Expand row" height="20px;" src="<?=base_url()?>images/arrows.png"></a-->
	<a href="#ee" onclick="toggleRow1(this);" class="btn-sm" id="avasecond" data-toggle="popover">
		<span class="glyphicon glyphicon-hand-down" aria-hidden="true"></span>
	</a>
		<?php $uri=site_url('auctions/auction/'.$secondary['auctionId']);?>
	<!-- >a href=<?php echo $uri;?> target="_blank"><img alt="Expand row" height="20px;" src="<?=base_url()?>images/arrows.png"></a-->
		<a href=<?php echo $uri;?> target="_blank" class="btn-sm"  id="avalaen" data-toggle="popover">
	<span class="glyphicon glyphicon-folder-open" aria-hidden="true" align="left"></span>
	</a>
	
	</td>
	<?php 
	if ($secondary['age']!=NULL) {
		?><td  style="background: lightpink; font-size: 1.2em"><b><?php echo $secondary['age'];?></b></td><?php 
	}
	?>
	<?php 
	if ($secondary['isMy']==1) {
		?><td  color="red" style="background: lightpink; font-size: 1.2em"><b><?php echo "M: ".$secondary['desiredDiscountRate']."%";?></b></td><?php 
	}
	?>

	</tr>
	<tr  class="parentRow" id="hidethis2" style="display: none;" name="parentRow">
		<td colspan="15">
			<table class="table table-bordered table-striped report2" id="report2">
				<tbody>
					<tr>
						<th style="text-align: right; white-space: nowrap;" >#Id</th>
						<td style="white-space: nowrap;"><?php echo $secondary['id'];?></td>
						<th style="text-align: right; white-space: nowrap;">#LoanPartId</th>
						<td style="white-space: nowrap;"><?php echo $secondary['loanPartId'];?></td>
						<th style="text-align: right; white-space: nowrap;">#Amount</th>
						<td style="white-space: nowrap;"><?php echo $secondary['amount'];?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#AuctionId</th>
						<td style="white-space: nowrap;"><a href=<?php echo "https://www.bondora.ee/en/Auction/Show/".$secondary['auctionId'];?> target="_blank"><?php echo $secondary['auctionId'];?></a></td>
						<th style="text-align: right; white-space: nowrap;">#AuctionName</th>
						<td style="white-space: nowrap;"><?php echo $secondary['auctionName'];?></td>
						<th style="text-align: right; white-space: nowrap;">#AuctionNumber</th>
						<td style="white-space: nowrap;"><?php echo $secondary['auctionNumber'];?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#Country</th>
						<td style="white-space: nowrap;"><?php echo $countries[strtoupper($secondary['country'])];?></td>
						<th style="text-align: right; white-space: nowrap;">#AuctionBidNumber</th>
						<td style="white-space: nowrap;"><?php echo $secondary['auctionBidNumber'];?></td>
						<th style="text-align: right; white-space: nowrap;">#CreditScore</th>
						<td style="white-space: nowrap;"><?php echo $creditScore[$secondary['creditScore']];?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#Rating</th>
						<td style="white-space: nowrap;"><?php echo $secondary['rating'];?></td>
						<th style="text-align: right; white-space: nowrap;">#Interest</th>
						<td style="white-space: nowrap;"><?php echo $secondary['interest'];?></td>
						<th style="text-align: right; white-space: nowrap;">#UseOfLoan</th>
						<td style="white-space: nowrap;"><?php echo $useOfLoan[$secondary['useOfLoan']]?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#LoanStatusCode</th>
						<td style="white-space: nowrap;" ><?php echo $loanStatusCode[$secondary['loanStatusCode']]?></td>
						<th style="text-align: right; white-space: nowrap;">#IncomeVerificationStatus</th>
						<td style="white-space: nowrap;"><?php echo $verificationType[strtoupper($secondary['incomeVerificationStatus'])];?></td>
						<th style="text-align: right; white-space: nowrap;">#Gender</th>
						<td style="white-space: nowrap;"><?php echo $gender[$secondary['gender']]?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#DateOfBirth</th>
						<td style="white-space: nowrap;"><?php echo substr($secondary['dateOfBirth'],0,10);?></td>
						<th style="text-align: right; white-space: nowrap;">#SignedDate</th>
						<td style="white-space: nowrap;"><?php //echo $secondary['signedDate'];?>
						<?php echo str_replace("T"," ",substr($secondary['signedDate'],0,19));?>
						</td>
						<th style="text-align: right; white-space: nowrap;">#ReScheduledOn</th>
						<td style="white-space: nowrap;"><?php //echo $secondary['reScheduledOn'];?>
						<?php echo str_replace("T"," ",substr($secondary['reScheduledOn'],0,19));?>
						</td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#DebtOccuredOn</th>
						<td style="white-space: nowrap;"><?php //echo $secondary['debtOccuredOn']?>
						<?php  if ($secondary['debtOccuredOn']!='') echo str_replace("T"," ",substr($secondary['debtOccuredOn'],0,19));?>
						</td>
						<th style="text-align: right; white-space: nowrap;">#DebtOccuredOnForSecondary</th>
						<td style="white-space: nowrap;"><?php //echo $secondary['debtOccuredOnForSecondary']?>
						<?php  if ($secondary['debtOccuredOnForSecondary']!='') echo str_replace("T"," ",substr($secondary['debtOccuredOnForSecondary'],0,19));?>
						</td>
						<th style="text-align: right; white-space: nowrap;">#NextPaymentNr</th>
						<td style="white-space: nowrap;"><?php echo $secondary['nextPaymentNr']?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#NextPaymentDate</th>
						<td style="white-space: nowrap;"><?php //echo $secondary['nextPaymentDate']?>
						<?php echo substr($secondary['nextPaymentDate'],0,10);?>
						</td>
						<th style="text-align: right; white-space: nowrap;">#NextPaymentSum</th>
						<td style="white-space: nowrap;"><?php echo $secondary['nextPaymentSum']?></td>
						<th style="text-align: right; white-space: nowrap;">#NrOfScheduledPayments</th>
						<td style="white-space: nowrap;"><?php echo $secondary['nrOfScheduledPayments']?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#PrincipalRepaid</th>
						<td style="white-space: nowrap;"><?php echo $secondary['principalRepaid']?></td>
						<th style="text-align: right; white-space: nowrap;">#InterestRepaid</th>
						<td style="white-space: nowrap;"><?php echo $secondary['interestRepaid']?></td>
						<th style="text-align: right; white-space: nowrap;">#LateAmountPaid</th>
						<td style="white-space: nowrap;"><?php echo $secondary['lateAmountPaid']?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#PrincipalRemaining</th>
						<td style="white-space: nowrap;"><?php echo $secondary['principalRemaining']?></td>
						<th style="text-align: right; white-space: nowrap;">#PrincipalLateAmount</th>
						<td style="white-space: nowrap;"><?php echo $secondary['principalLateAmount']?></td>
						<th style="text-align: right; white-space: nowrap;">#InterestLateAmount</th>
						<td style="white-space: nowrap;"><?php echo $secondary['interestLateAmount']?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#PenaltyLateAmount</th>
						<td style="white-space: nowrap;"><?php echo $secondary['penaltyLateAmount']?></td>
						<th style="text-align: right; white-space: nowrap;">#LateAmountTotal</th>
						<td style="white-space: nowrap;"><?php echo $secondary['lateAmountTotal']?></td>
						<th style="text-align: right; white-space: nowrap;">#Price</th>
						<td style="white-space: nowrap;"><?php echo $secondary['price']?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#Fee</th>
						<td style="white-space: nowrap;"><?php echo $secondary['fee']?></td>
						<th style="text-align: right; white-space: nowrap;">#TotalCost</th>
						<td style="white-space: nowrap;"><?php echo $secondary['totalCost'];?></td>
						<th style="text-align: right; white-space: nowrap;">#OutstandingPayments</th>
						<td style="white-space: nowrap;"><?php echo $secondary['outstandingPayments']?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;">#DesiredDiscountRate</th>
						<td style="white-space: nowrap;"><?php echo $secondary['desiredDiscountRate']?></td>
						<th style="text-align: right; white-space: nowrap;">#Xirr</th>
						<td style="white-space: nowrap;"><?php echo $secondary['xirr']?></td>
						<th style="text-align: right; white-space: nowrap;">#ListedOnDate</th>
						<td style="white-space: nowrap;"><?php //echo $secondary['listedOnDate']?>
						<?php echo str_replace("T"," ",substr($secondary['listedOnDate'],0,19));?>
						</td>
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

<button type="submit" name="submit" value="formCancelSecondary">Saada katkestamine Bondoorasse(�KSHAAVAL)</button>
<button type="submit" name="submit" value="formBuySecondary"><?php echo anchor('bids/secondarybuy', "Saada sec.mark ost Bondoorasse");?></button>
</form>
</div>
