<style>
#nav-btn { display: none; }
#back-btn { display: block; }
.nav-bar { display: none;}
</style>
	<ul data-role="listview" data-mini="true">
		<li data-role="list-divider">Navigation</li>
	    <li><a href="#">Dashboard</a></li>
	    <li><a href="<?php echo base_url();?>task/add">Add a Task</a></li>
	    <li><a href="<?php echo base_url();?>task/list">Task Lists</a></li>
	    <li><a href="#">Manage Groups</a></li>
	    <li><a href="#">Settings</a></li>
	    <li><a href="<?php echo base_url();?>portal/support">Support & Help</a></li>

	    	<?php
        		if($this->session->userdata('logged') == '') { ?>
					<li style="display:none;"></li>
        		<?php } else { ?>
        			<li><a href="<?php echo base_url(); ?>auth/logoff" data-transition="flip" id="login-btn">Log Out</a></li>
        	<?php } ?>

	</ul>