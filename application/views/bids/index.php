<div id="show_table">
       <?php 
       $current_url=current_url();
       get_instance()->session->set_userdata('current_url', $current_url);
        
       
        	$statusCode = array(
                  '0' => 'Pending',
                  '1' => 'Open',
                  '2' => 'Successful',
                  '3' => 'Failed',
        		  '4' => 'Cancelled',
     '5' => 'Accepted',          );
        ?>
       <?php
        	$failureReason = array(
                  '0' => 'NotSet',
                  '1' => 'AvailableAmountLowerThanMinInvestmentLimit',
                  '2' => 'BiddingOnOwnAuction',
        			'3' => 'BiddingOnInactiveDuplicate',
        			'4' => 'BiddingAmountTooSmall',
        			'5' => 'NotEnoughBalance',
        			'6' => 'AuctionIsClosed',
        			'7' => 'AuctionStatusNotOpen',
        			'8' => 'NoRiskScoreForAuction',
        			'9' => 'AuctionAlreadyFullyBidded',
        			'10' => 'AuctionNotFound',
        			'11' => 'NotEnoughLoanAmountForBiddingAmount',
        			'12' => 'ApiUsageNotAllowed',
        			'13' => 'AuctionIsCancelled',
        			'14' => 'Unknown',        			
                );
        ?>
        
    <?php $attributes = array("class" => "form-horizontal", "id" => "bidsform", "name" => "bidsform");?>
    <?php echo form_open('bids/cancel', $attributes); ?>
    

<nav class="navbar navbar-default navbar-fixed-top">
<div class="navbar-collapse collapse">
<ul id="rep1" class="nav navbar-nav">
  <li id="rep1" role="presentation"><a href="<?php echo site_url('auctions/index/')?>">Laenuküsimised</a></li>
  <li id="rep1" role="presentation" ><a href="<?php echo site_url('investments/index')?>">Minu investeeringud</a></li>
  <li id="rep1" role="presentation" ><a href="<?php echo site_url('secondary/index')?>">Järelturg</a></li>
  <li id="rep1" role="presentation" class="active"><a class="active" href="<?php echo site_url('bids/download')?>">Lae Bondoorast minu pakkumised</a></li>
  <!-- li id="rep1" role="presentation"><a href="-->
  <?php //echo site_url('filters/index')?>
  <!-- ">Filtrid</a></li-->
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

<?php //echo anchor('bids/download',"Lae Bondoorast minu pakkumised");?> 
<?php //echo anchor('auctions/index',"Investeeringu k�simised");?> 
<?php //echo anchor('investments/index', "Minu investeeringud");?> 
<?php //echo anchor('secondary/index', "Secondary Market");?>

        
    <?php if($this->session->flashdata('msg')) { ?>
	<div class="alert alert-success alert-dismissible text-center" role="alert">
		<?php echo "<strong>Teade:</strong> ".$this->session->flashdata('msg'); ?>
	</div><br><?php } ?>
        <?php if($this->session->flashdata('err')) { ?>
	<div class="alert alert-danger alert-dismissible text-center" role="alert">
		<?php echo "<strong>Viga:</strong> ".$this->session->flashdata('err'); ?>
	</div><br><?php } ?>

    <?php $attributes = array("method" => "post", "class" => "form-horizontal", "id" => "bidsFilterform", "name" => "bidsFilterform");?>
    <?php echo form_open('bids/index', $attributes); ?>   

       <?php
        	$stat = array(
                  '' => 'Kõik',
                  '0' => 'Pending',
                  '1' => 'Open',
                  '2' => 'Successful',
                  '3' => 'Failed',
        		  '4' => 'Cancelled',
        			);
        ?>
        <label for="stat">Staatus:</label>
        <?php echo form_dropdown('stat', $stat, set_value('stat',$stat), 'style=width: 240px; font-size: 13px'); ?>

<button type="submit" name="submitForm" value="formFilter">Aktiveeri filter</button>
</form>


    <?php $attributes = array("class" => "form-horizontal", "id" => "bidsform", "name" => "bidsform");?>
    <?php echo form_open('bids/cancel', $attributes); ?>

<?php //echo anchor('bids/download',"Lae Bondoorast minu pakkumised");?> 
<?php //echo anchor('auctions/index',"Investeeringu k�simised");?> 
<?php //echo anchor('investments/index', "Minu investeeringud");?> 
<?php //echo anchor('secondary/index', "Secondary Market");?>

<button type="submit" name="submit" value="formCancelBid">Katkesta märgitud investeeringu pakkumised</button>

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


<table class="table table-striped table-bordered table-condensed table-hover" id="report1">

	<thead>
	<tr style="display: table-row; background-color: lightgray">
		<?php //<th>##</th>?>
		<th id="toggle">
				<?php 
				echo form_checkbox('chks', 0, set_checkbox('chks', 0, ''));
				?>
		
		#</th>
<?php //		<th>Auction ID</th> ?>
		<th>BidId</th>
<?php //		<th>Auction Bid</th>?>
		<th>AuctionId</th>
<?php //		<th>Loan Id</th> ?>
		<th>Req-dBidAm</th>
		<th>ActualBidAm</th>
		<th>Req-dBidMin</th>
		<th>BidReq-d</th>
		<th>BidProc-d</th>
		<th>IsReqProc-d</th>
		<th>StatusCode</th>
		<th>Failure</th>
		<th>Ava</th>
	</tr>
	</thead>
	<tbody>
	<?php 
	$summa=0;
	$idx=0;
	foreach ($bids as $bid):
	if ($stat1=='' || ($stat1!='' && $stat1==($bid['statusCode']))) {
		//echo "riik=".$riik1;
	} else {
		//echo "valitud riik=".$riik1."   tegelik=".$investment['country']."<br>";
		continue;
	}
	
	$idx++;
	?>
						<?php 
							$col="";
							if ($bid['statusCode']==3)
								$col='color="red" class="red"';
							if ($bid['statusCode']==4)
								$col='color="red" class="red"';
							if ($bid['statusCode']==2)
								$col='color="green" class="green"';
							if ($bid['statusCode']==1)
								$col='color="yellow" class="yellow"';
										
						?>
						<?php 
							$col1="";
							if ($bid['statusCode']==3)
								$col1='color="red" name="red"';
							if ($bid['statusCode']==4)
								$col1='color="red" name="red"';
							if ($bid['statusCode']==2)
								$col1='color="green" name="green"';
							if ($bid['statusCode']==1)
								$col1='color="yellow" name="yellow"';
										
						?>
	
	<tr style="cursor: pointer !important;" class="odd" <?php echo $col;?>  onmouseover="ChangeColor(this, true);" onmouseout="ChangeColor(this, false);">
	<?php //<td><a href="#" onclick="toggleRow1(this);"><img alt="Expand row" height="20px;" src="<?=base_url() >images/arrows.png"></a></td> ?>
				<td>
				<?php 
				echo form_checkbox('id'.$bid['id'], $idx, set_checkbox('id'.$bid['id'], $idx, ''));
				?>
				<?php echo $idx?>
				
				</td>

<?php 
//				if ($investment['debtOccuredOn']!=NULL)
//				{
//					$noh1 = time(); // or your date as well
//					$noh2 = strtotime($investment['debtOccuredOn']);
//					$datediff = $noh1 - $noh2;
//				}
				?>
<?php
//				if ($investment['debtOccuredOn']!=NULL)
//				{
?>
		<td <?php echo $col;?>> 
		<?php echo $bid['bidId'];
		//echo substr($investment['purchaseDate'],0,10)."->".substr($investment['debtOccuredOn'],0,10)." (".floor($datediff/(60*60*24))."p�eva)";
		?>
		
		</td>
<?php 
//				} else {
					?>
		<td <?php echo $col;?>>
		<?php //echo $bid['auctionId'];?>
		<a href=<?php echo "https://www.bondora.ee/en/Auction/Show/".$bid['auctionId'];?> target="_blank"><?php echo $bid['auctionId'];?></a>
		<?php //echo substr($investment['purchaseDate'],0,10)."->".substr($investment['debtOccuredOn'],0,10);
					?></td>

<?php 
//				}
?>


		<td <?php echo $col;?>><?php echo $bid['requestedBidAmount']?></td>
		<td <?php echo $col;?>><?php echo $bid['actualBidAmount'];?></td>
		<td <?php echo $col;?>><?php echo $bid['requestedBidMinimumLimit'];?></td>
		<td <?php echo $col;?>><?php //echo $bid['bidRequestedDate'];?>
		<?php echo str_replace("T"," ",substr($bid['bidRequestedDate'],0,19));?>
		</td>
		<td <?php echo $col;?>><?php //echo $bid['bidProcessedDate'];?>
		<?php echo str_replace("T"," ",substr($bid['bidProcessedDate'],0,19));?>
		</td>
		<td <?php echo $col;?>><?php echo $bid['IsRequestBeingProcessed'];?></td>
		<td <?php echo $col;?>><?php echo $statusCode[$bid['statusCode']]?></td>
		<td <?php echo $col;?>><?php echo $failureReason[$bid['failureReason']]?></td>

	<td><!-- >div class="arrow" id="arrow"></div-->
	<?php $uri=site_url('auctions/auction/'.$bid['auctionId']);?>
	<!-- a href=<?php echo $uri;?> target="_blank"><img alt="Expand row" height="20px;" src="<?=base_url()?>images/arrows.png"></a-->
		<a href=<?php echo $uri;?> target="_blank" class="btn-sm">
	<span class="glyphicon glyphicon-folder-open" aria-hidden="true" align="left"></span>
	</a>
	
	</td>
	</tr>

	<?php endforeach;
	?>
								
	</tbody>
	<tfoot>
	
	<tr>
	
		<th colspan="999">Laene: <?php echo $all['sum'];?> | Koguaeg: <?php echo $all['all_time']?>sek | Allalaadimiseks kulus: <?php echo $all['down_time']?>sek</th>

	</tr>
	</tfoot>
</table>
<button type="submit" name="submit" value="formCancelBid">Katkesta märgitud investeeringu pakkumised</button>
</form>

</div>