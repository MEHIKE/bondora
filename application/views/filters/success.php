<?php if($this->session->flashdata('msg')) { ?>
	<div class="alert alert-success">
		<?php echo $this->session->flashdata('msg') ?>
	</div><?php } ?>
    <button type="submit" name="submit" value="form"><?php echo anchor($this->session->flashdata('redirect'),$this->session->flashdata('redirect_msg'));?></button>
<?php 
if ($this->session->flashdata('tagasi')==1 AND isset($tagasi)) {?>
	<button type="submit" name="submit" value="formBack"><?php echo anchor($this->session->flashdata('redirect_back'),$this->session->flashdata('redirect_back_msg'));?></button>
<?php }
?>	