     <?php $attributes = array("method" => "post", "class" => "form-horizontal", "id" => "investmentsform", "name" => "investmentsform");?>
<?php echo form_open('investments/index', $attributes); ?>
<?php if($this->session->flashdata('msg')) { ?>
	<div class="alert alert-success alert-dismissible text-center">
		<?php echo $this->session->flashdata('msg') ?>
	</div><?php } ?>
	    <?php if($this->session->flashdata('err')) { ?>
	<div class="alert alert-danger alert-dismissible text-center" role="alert">
		<?php echo '<strong>Viga:</strong> '.$this->session->flashdata('err'); ?>
	</div><br><?php } ?>
    <button type="submit" name="submit" value="form"><?php echo anchor($this->session->flashdata('redirect'),$this->session->flashdata('redirect_msg'));?></button>
<?php 
if ($this->session->flashdata('tagasi')==1 AND isset($tagasi)) {?>
	<button type="submit" name="submit" value="formBack"><?php echo anchor($this->session->flashdata('redirect_back'),$this->session->flashdata('redirect_back_msg'));?></button>
<?php }

$this->table->set_empty("Pole määratud");
?>

<table class="table table-striped table-bordered table-condensed table-hover" id="report1">

<thead>
<tr style="display: table-row;">
		<th>success</th>
		<th>SecondaryId</th>
		<th>Cancelled</th>
	</tr>
	</thead>
	<tbody>
	<?php 
	$idx=0;
	//foreach ($payloads as $payload):
	$idx++;
	?>
	<tr style="cursor: pointer !important;" class="odd">
		<td><?php echo 'true';//echo $payload['Id']?></td>
		<td><?php echo $secondaryId?></td>
		<td><?php echo "Not cancelled";?></td>
	</tr>

	<?php //endforeach;
	?>
	</tbody>
	<tfoot>
	<tr>
		<th colspan="999">Kokku: <?php echo $idx;?>tk</th>
	</tr>
	</tfoot>
</table>
</form>