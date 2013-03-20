<style>
#back-btn { display: block; }
</style>
	<div class="content">
	<form>
	    <fieldset data-role="collapsible" data-theme="a">
	        <legend>Register for an Account</legend>
	        	<h2>You surely have one of these...</h2>
	        	<p>
	        		One (ok, maybe like 3) click registration!
	        	</p>
	        	<ul data-role="listview">
	        		<li><a href="#" class="ui-disabled">Twitter</a></li>
	        		<li><a href="auth/facebook">Facebook</a></li>
	        		<li><a href="#" class="ui-disabled">Google ID</a></li>
	        	</ul>
	        	<h2>Ol' Fashioned Method</h2>
				<label for="username">Desired Username</label>
				<input type="text" name="username" id="username" value="">
				<label for="username">Password</label>
				<input type="password" name="username" id="username" value="">
				<label for="username">Email Address</label>
				<input type="text" name="username" id="username" value="">
				<input type="submit" value="Register" data-theme="g">
	    </fieldset>
	</form>
	<form action="auth/process" method="post" data-ajax="false">
	    <fieldset data-role="collapsible" data-collapsed="false" data-theme="a">
	        <legend>Login</legend>
	        	<em>You know the drill, gimmie your</em>
				<label for="username"><strong>Username</strong></label>
				<input type="text" name="username" id="username" value="">
				<label for="username"><strong>Password</strong></label>
				<input type="password" name="username" id="username" value="">
				<input type="submit" value="Login" data-theme="g">
	    </fieldset>
	</form>

	</div><!-- /content -->