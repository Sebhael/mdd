<?php $this->load->view('/inc/header'); ?>

<div class="main">
	<?php $this->load->view($mainBlock); ?>
</div>

<div class="sidebar">
	<div data-role="content">
	<?php foreach($modules as $module) {
		$this->load->view('/modules/'.$module);
	}
	?>
</div>
</div>

<?php $this->load->view('/inc/footer'); ?>