<?php if($this->session->flashdata('msg')) { ?>
	<div class="alert alert-success alert-dismissible text-center">
		<?php echo $this->session->flashdata('msg') ?>
	</div><?php } ?>
    <?php //<button type="submit" name="submit" value="form"> ?>
    *<?php echo anchor($this->session->flashdata('redirect'),$this->session->flashdata('redirect_msg'));?>*
    <?php //</button> ?>
<?php 
if ($this->session->flashdata('tagasi')==1 AND isset($tagasi)) {?>
	<?php //<button type="submit" name="submit" value="formBack"> ?>
	| *<?php echo anchor($this->session->flashdata('redirect_back'),$this->session->flashdata('redirect_back_msg'));?>*
	<?php //</button> ?>
<?php }

$this->table->set_empty("Pole m��ratud");
?>

<table class="table table-striped table-bordered table-condensed table-hover" id="report1">

<thead>
<tr style="display: table-row;">
		<th>AuctionId</th>
		<th>Amount</th>
		<th>MinAmount</th>
	</tr>
	</thead>
	<tbody>
	<?php 
	$idx=0;
	foreach ($bids as $payload):
	$idx++;
	?>
	<tr style="cursor: pointer !important;" class="odd">
		<td><?php echo $payload['AuctionId']?></td>
		<td><?php echo $payload['Amount']?></td>
		<td><?php echo $payload['MinAmount'];?></td>
	</tr>

	<?php endforeach;
	?>
	</tbody>
	<tfoot>
	<tr>
		<th colspan="999">Kokku: <?php echo $idx;?>tk</th>
	</tr>
	</tfoot>
</table>
	
	