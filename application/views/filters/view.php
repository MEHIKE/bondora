<?php
echo '<h2>'.$filters_item['id'].'</h2>';
echo $filters_item['user'];

if($this->session->flashdata('msg')) { ?>
	<div class="alert alert-success">
		<?php echo $this->session->flashdata('msg'); ?>
	</div><?php } ?>
    <button type="submit" name="submit" value="formBack"><?php echo anchor($this->session->flashdata('redirect'),$this->session->flashdata('redirect_msg'));?></button>
