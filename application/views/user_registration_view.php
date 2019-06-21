<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CodeIgniter User Registration Form Demo</title>
	<link href="<?php echo base_url("bootstrap/css/bootstrap.css"); ?>" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="container">
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<?php echo $this->session->flashdata('verify_msg'); ?>
	</div>
</div>

<div class="row">
	<div class="col-md-4 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="form-signin-heading">User Registration Form</h4>
			</div>
			<div class="panel-body">
				<?php $attributes = array("name" => "registrationform", "class" => "form-signin");
				echo form_open("user/register", $attributes);?>
				<div class="form-group">
					<label class="sr-only" for="name">Username</label>
					<input class="form-control" name="username" placeholder="Kasutajanimi" type="text" value="<?php echo set_value('username'); ?>" />
					<span class="text-danger"><?php echo form_error('username'); ?></span>
				</div>

				<div class="form-group">
					<label class="sr-only" for="name">First Name</label>
					<input class="form-control" name="fname" placeholder="Your First Name" type="text" value="<?php echo set_value('fname'); ?>" />
					<span class="text-danger"><?php echo form_error('fname'); ?></span>
				</div>

				<div class="form-group">
					<label class="sr-only" for="name">Last Name</label>
					<input class="form-control" name="lname" placeholder="Last Name" type="text" value="<?php echo set_value('lname'); ?>" />
					<span class="text-danger"><?php echo form_error('lname'); ?></span>
				</div>
				
				<div class="form-group">
					<label class="sr-only" for="email">Email ID</label>
					<input class="form-control" name="email" placeholder="Email-ID" type="text" value="<?php echo set_value('email'); ?>" />
					<span class="text-danger"><?php echo form_error('email'); ?></span>
				</div>

				<div class="form-group">
					<label class="sr-only" for="subject">Password</label>
					<input class="form-control" name="password" placeholder="Password" type="password" />
					<span class="text-danger"><?php echo form_error('password'); ?></span>
				</div>

				<div class="form-group">
					<label class="sr-only" for="subject">Confirm Password</label>
					<input class="form-control" name="cpassword" placeholder="Confirm Password" type="password" />
					<span class="text-danger"><?php echo form_error('cpassword'); ?></span>
				</div>

				<div class="form-group">
					<button name="submit" type="submit" class="btn btn-primary btn-default">Signup</button>
					<button name="cancel" type="reset" class="btn btn-primary btn-default">Cancel</button>
					<input id="btn_login" name="btn_login" type="submit" class="btn btn-default" value="Login" />
				</div>
				<?php echo form_close(); ?>
				<?php echo $this->session->flashdata('msg'); ?>
			</div>
		</div>
	</div>
</div>
</div>
</body>
</html>