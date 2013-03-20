<style>
#nav-btn { display: none; }
#back-btn { display: block; }
.nav-bar { display: none;}
</style>
	<ul data-role="listview" data-mini="true">
		<li data-role="list-divider">Navigation</li>
	    <li><a href="#">Dashboard</a></li>
	    <li><a href="#">Add a Task</a></li>
	    <li><a href="#">Task Lists</a></li>
	    <li><a href="#">Manage Groups</a></li>
	    <li><a href="#">Settings</a></li>
	    <li><a href="#">Support & Help</a></li>
	    	<?php
        		if($this->session->userdata('logged') == '') { ?>
					<li style="display:none;"></li>
        		<?php } else { ?>
        			<li><a href="<?php echo base_url(); ?>auth" data-transition="flip" id="login-btn">Log Out</a></li>
        	<?php } ?>
	</ul>