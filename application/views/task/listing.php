<style>
#back-btn { display: block; }
textarea { resize: none;}
.nested { background: #37322c; border-radius: 5px; }
</style>
<div class="content">

	<?php echo $this->session->flashdata('success'); ?>

	<h3 style="text-align: center;"><?php echo $task['title'];?></h3>
	<small><em><strong>Started At</strong>: <?php echo reverse_date($task['created']);?></em></small>
	<small style="float:right"><em><strong>Completed At</strong>: <?php echo reverse_date($task['created']);?></em></small>
	<div class="content nested"><?php echo $task['notes'];?></div>

	<div class="ui-grid-solo">
	    <div class="ui-block-a"><a href="#" data-role="button" data-icon="check" data-iconpos="right" data-theme="f">Complete</a></div>
	</div>
	<fieldset class="ui-grid-a">
	    <div class="ui-block-a"><a href="#" data-role="button" data-icon="edit" data-iconpos="right" data-theme="d">Edit</a></div>
	    <div class="ui-block-b"><a href="#delete" data-rel="popup" data-role="button" data-icon="delete" data-iconpos="right" data-theme="e">Delete</a></div>
	</fieldset>

	<h3>Add A Note</h3>
	<form action="task/addcomment" method="post">
		<label for="comment">Notes</label>
		<textarea id="notes" name="id"></textarea>
		<label for="asset">Add a File</label>
		<input type="file" name="asset" id="asset" />
		<a href="#" data-role="button">Submit Note</a>
	</form>

</div>

<div data-role="popup" id="delete" data-overlay-theme="a" data-theme="c" data-dismissible="false" style="max-width:400px;" class="ui-corner-all">
    <div data-role="header" data-theme="a" class="ui-corner-top">
        <h1>Delete Task?</h1>
    </div>
    <div data-theme="d" class="ui-corner-bottom ui-content">
        <h3 class="ui-title">Are you sure you want to delete this page?</h3>
        <p>This action cannot be undone, unless you're a wizard.</p>
        <a href="#" data-role="button" data-inline="true" data-rel="back" data-theme="c">Cancel</a>
        <a href="<?=base_url();?>task/delete/<?=$task['id']?>" data-role="button" data-ajax="false" data-inline="true" data-transition="flow" data-theme="b">Delete</a>
    </div>
</div>