<!DOCTYPE html>
<html>
<head>
	<title>TaskManager</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>test/taskmanager.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>test/main.css" />
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.js"></script>
</head>

<body>

<div data-role="page" id="page">

	<div id="mobile-head" data-role="header">
		<a href="" data-rel="back" data-role="button" data-mini="true" data-icon="back" data-transition="flip" data-theme="a" data-inline="true" id="back-btn" class="ui-btn-left">Back</a>
		<h1><?php echo $pageTitle; ?></h1>
		<a href="portal/nav" data-role="button" data-mini="true" data-icon="grid" data-transition="flip" data-theme="a" data-inline="true" id="nav-btn" class="ui-btn-right">Menu</a>
	</div><!-- /header -->

    <?php if($this->session->userdata('logged') == 1) { ?>
        <span style="float: right;padding:5px;">
            Logged in as: <strong><a href="members/profile"><?php echo ucfirst($this->session->userdata('username')); ?></a></strong></span>
    <?php } ?>

	<h1 id="logo"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url();?>test/logo.png"/></a></h1>
    	
    <div class="nav-bar" data-role="navbar">
    <ul>
        <li id="expand">
        	<?php
        		if($this->session->userdata('logged') == '') { ?>
        		<a href="<?php echo base_url(); ?>auth" data-transition="flip" id="login-btn">Login</a>
        		<?php } else { ?>
        	<a href="<?php echo base_url();?>task/add" data-transition="slide">Add</a>
        	<?php } ?>
        </li>
        <li id="expand"><a href="<?php echo base_url(); ?>task/lists" data-transition="flip">Lists</a></li>
        <li id="expand"><a href="#">Groups</a></li>
        <li class="hide"><a href="#">Something</a></li>
        <li class="hide"><a href="<?php echo base_url();?>portal/support">Support</a></li>
    </ul>
	</div><!-- /navbar -->