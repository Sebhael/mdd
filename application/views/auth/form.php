<style>
#back-btn { display: block; }
div.error { background: red; font-weight: bold; padding: 5px; border-radius: 5px; }
</style>
	<div class="content">
	<form action="<?=base_url()?>auth/register" method="post" data-ajax="false">
	    <fieldset data-role="collapsible" data-theme="a">
	        <legend>Register for an Account</legend>
				<label for="username">Desired Username</label>
				<input type="text" name="username" id="username" value="">
				<label for="username">Password</label>
				<input type="password" name="password" id="password" value="">
				<label for="username">Password Confirmation</label>
				<input type="password" name="password-conf" id="password-conf" value="">
				<label for="username">Email Address</label>
				<input type="text" name="email" id="email" value="">
				<input type="submit" value="Register" data-theme="g">
	    </fieldset>
	</form>
	<form action="<?=base_url()?>auth/process" method="post" data-ajax="false">
	    <fieldset data-role="collapsible" data-collapsed="false" data-theme="a">
	    	<?php echo $this->session->flashdata('success_r'); ?>
	        <legend>Login</legend>
	        	<!--<a href="#" data-role="button">Login via Facebook</a>-->
	        	<em>You know the drill, gimmie your...</em>
				<label for="username"><strong>Username</strong></label>
				<?php echo form_error('username'); ?>
				<input type="text" name="username" id="username" class="required" value="">
				<label for="username"><strong>Password</strong></label>
				<?php echo form_error('password'); ?>
				<input type="password" name="password" id="password" value="">
				<input type="submit" value="Login" data-theme="g">
	    </fieldset>
	</form>

	</div><!-- /content -->