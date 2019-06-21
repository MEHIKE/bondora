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
    

<?php if($this->session->flashdata('msg')) { ?>
	<div class="alert alert-danger alert-dismissible text-center" role="alert">
		<?php echo $this->session->flashdata('msg') ?>
	</div><?php } ?>
    <?php //<button type="submit" name="submit" value="form"> ?>
    <!-- >?php echo anchor($this->session->flashdata('redirect'),$this->session->flashdata('redirect_msg'));?-->
    <?php //</button> 
	$this->session->set_flashdata('msg', false); 
?>
<?php 
if ($this->session->flashdata('tagasi')==1 AND isset($tagasi)) {?>
	<?php //<button type="submit" name="submit" value="formBack"> ?>
	| *<?php echo anchor($this->session->flashdata('redirect_back'),$this->session->flashdata('redirect_back_msg'));?>*
	<?php //</button> 
?>
<?php }

$this->table->set_empty("Pole määratud");
?>

<table class="table table-striped table-bordered table-condensed table-hover" id="report1">

<thead>
<tr style="display: table-row;">
		<th>Veakood</th>
		<th>Veateade</th>
		<th>Vea detailid</th>
	</tr>
	</thead>
	<tbody>
	<?php 
	$idx=0;
	foreach ($errors as $payload):
	$idx++;
	?>
	<tr style="cursor: pointer !important;" class="odd">
		<td><?php echo $payload->Code?></td>
		<td><?php echo $payload->Message?></td>
		<td><?php echo $payload->Details?></td>
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
	
	