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
    <?php if($this->session->flashdata('msg')) { ?>
	<div class="alert alert-success alert-dismissible text-center">
		<?php echo "Message=".$this->session->flashdata('msg'); ?>
	</div><?php } ?>
    <br>    

    <?php $attributes = array("class" => "form-horizontal", "id" => "bidsform", "name" => "bidsform");?>
    <?php echo form_open('bids/index', $attributes); ?>

<button type="submit" name="submit" value="formBids"><?php echo anchor('bids/index',"Bondoorast uued investeerimispakkumised");?></button>
<button type="submit" name="submit" value="formInvestments"><?php echo anchor('investments/index', "Minu investeeringud");?></button>
<button type="submit" name="submit" value="formAuctions"><?php echo anchor('auctions/index',"Investeeringu k�simised");?></button>
<br>        

<?php 
$this->table->set_empty("Pole m��ratud");
?>


<table class="table table-striped table-bordered table-condensed table-hover" id="report1">

	<thead>
	<tr style="display: table-row;">
		<?php //<th>##</th>?>
		<th>Staatus</th>
		<th>Selgitus</th>
		<th>BidId</th>
		<th>AuctionId</th>
		<th>Ava</th>
	</tr>
	</thead>
	<tbody>
	<?php 
	$idx=0;
	foreach ($results as $result):
	$idx++;
	?>
						<?php 
							$col="";
							if (!$result['success'])
								$col='color="red" class="red"';
							else // ($result['success']==1)
								$col='color="green" class="green"';
										
						?>
						<?php 
//							$col1="";
//							if ($investment['loanStatusCode']==5)
//								$col1='id="red" name="red"';
//							if ($investment['loanStatusCode']==100)
//								$col1='id="yellow" name="yellow"';
//							if ($investment['loanStatusCode']==4)
//								$col1='id="green" name="green"';
								
						?>
						<?php 
							$col1="";
							if (!$result['success'])
								$col1='color="red" name="red"';
							else //($result['success']==1)
								$col1='color="green" name="green"';
										
						?>
	
	<tr style="cursor: pointer !important;" class="odd" <?php echo $col1;?>>
		<td> 
		<?php if ($result['success']) 
				echo "�nnestus";
			else 	
				echo "Ei õnnestunud";
		?>
		</td>

		<td>
	    <?php if($result['errors'][0]->Message) { ?>
		
			<?php echo $result['errors'][0]->Message; 
		}
			?>
		</td>

		<td><?php echo $ids[$idx-1]['bidId']?></td>
		<td><a href=<?php echo "https://www.bondora.ee/en/Auction/Show/".$ids[$idx-1]['auctionId'];?> target="_blank"><?php echo $ids[$idx-1]['auctionId']?></td>
	<td><div class="arrow" id="arrow"></div>
	<a href="#ee" onclick="toggleRow1(this);"><img alt="Expand row" height="20px;" src="<?=base_url()?>images/arrows.png"></a>
	</td>
	</tr>
	<tr  class="parentRow" id="hidethis2" style="display: none;" name="parentRow" colspan="9999">
		<td colspan="6">
			<table class="table table-bordered table-striped report2" id="report2">
				<tbody>
					<tr>
						<th style="text-align: right; white-space: nowrap;" >#Id</th>
						<td style="white-space: nowrap;"><?php echo $ids[$idx-1]['bidId'];?></td>
						<th style="text-align: right; white-space: nowrap;">#auctionId</th>
						<td style="white-space: nowrap;"><?php echo $ids[$idx-1]['auctionId'];?></td>
						<th style="text-align: right; white-space: nowrap;">#requestedBidAmount</th>
						<td style="white-space: nowrap;"><?php echo $ids[$idx-1]['requestedBidAmount'];?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;" >#actualBidAmount</th>
						<td style="white-space: nowrap;"><?php echo $ids[$idx-1]['actualBidAmount'];?></td>
						<th style="text-align: right; white-space: nowrap;">#requestedBidMinimumLimit</th>
						<td style="white-space: nowrap;"><?php echo $ids[$idx-1]['requestedBidMinimumLimit'];?></td>
						<th style="text-align: right; white-space: nowrap;">#statusCode</th>
						<td style="white-space: nowrap;"><?php echo $statusCode[$ids[$idx-1]['statusCode']];?></td>
					</tr>
					<tr>
						<th style="text-align: right; white-space: nowrap;" >#bidRequestedDate</th>
						<td style="white-space: nowrap;"><?php echo $ids[$idx-1]['bidRequestedDate'];?></td>
						<th style="text-align: right; white-space: nowrap;">#bidProcessedDate</th>
						<td style="white-space: nowrap;"><?php echo $ids[$idx-1]['bidProcessedDate'];?></td>
						<th style="text-align: right; white-space: nowrap;">#failureReason</th>
						<td style="white-space: nowrap;"><?php echo $failureReason[$ids[$idx-1]['failureReason']];?></td>
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
		<th colspan="999">Total: <?php echo $idx?></th>
	</tr>
	</tfoot>
</table>
<button type="submit" name="submit" value="formBack">Tagasi investeerimispakkumiste lehele</button>
</form>

</div>