<!DOCTYPE html>
<html>
<head>
	<title>Webslesson | <?php echo $title; ?></title>
	<link rel="stylesheet"

		  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
</head>
<body>
<div class="container">
	<br/><br/><br/>
	<form method="post" action="<?php echo base_url(); ?>user/login_validation">

		<div class="form-group">
			<label>Email</label>
			<input type="text" name="email" required class="form-control"/>
			<span class="text-danger"><?php echo form_error('email'); ?></span>
		</div>
		<div class="form-group">
			<label>Password</label>
			<input type="password" name="password" required class="form-control"/>
			<span class="text-danger"><?php echo form_error('password'); ?></span>
		</div>
		<div class="form-group">
			<input type="submit" name="insert" value="Login" class="btn btn-info"/>
			<?php echo '<label class="text-danger">' . $this->session->flashdata("error") . '</label>';?>
		</div>
	</form>
</div>
</body>
</html>
