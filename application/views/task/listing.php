<style>
#back-btn { display: block; }
textarea { resize: none;}
.nested { background: #37322c; border-radius: 5px; }
.note { padding: 5px; background: #2c2a27; border-radius: 5px }
</style>
<div class="content">

	<?php $this->session->set_flashdata('redirect', current_url()); ?>

	<?php 
	echo $this->session->flashdata('success'); echo $this->session->flashdata('deletion_n'); 
	echo $this->session->flashdata('success_e'); echo $this->session->flashdata('reported')
	?>
	<h3 style="text-align: center;"><?php echo $task['title'];?></h3>

	<small><em><strong>Started At</strong>: <?php echo reverse_datetime($task['created']);?></em></small>
	<?php if ($task['completed'] == 0): ?>
	<small style="float:right"><em><strong><?php echo datediff($task['created']);?> in Progress</strong></em></small>
	<?php else: ?>
	<small style="float:right"><em><strong>Completed At</strong>: <?php echo reverse_datetime($task['created']);?></em></small>
	<?php endif; ?>
	<div class="content nested"><?php echo $task['notes'];?></div>

	<?php if($task['completed'] == 0): ?>

	<div class="ui-grid-solo">
	    <div class="ui-block-a"><a href="#complete"  data-rel="popup" data-position-to="window" data-role="button" data-icon="check" data-iconpos="right" data-theme="f">Complete</a></div>
	</div>
	<fieldset class="ui-grid-a">
	    <div class="ui-block-a"><a href="<?php echo base_url()?>task/edit/<?=$task['owner']?>/<?php echo $task['slug']?>" data-ajax="false" data-role="button" data-icon="edit" data-iconpos="right" data-theme="d">Edit</a></div>
	    <div class="ui-block-b"><a href="#delete" data-rel="popup" data-position-to="window" data-role="button" data-icon="delete" data-iconpos="right" data-theme="e">Delete</a></div>
	</fieldset>

	<?php endif; ?>

	<?php foreach ($notes as $note): ?>
		<strong><?=$note['username']?></strong> 
			<span style='float:right'>
				<?php if($this->session->userdata('uid') != $task['owner']): ?>
				<a href="<?=base_url()?>task/report_c/<?=$note['id']?>" data-ajax="false" style="text-decoration: none">( ! )</a>
				<?php endif; ?>
				<?php if( 
					($this->session->userdata('uid') == $note['owner']) or 
					($this->session->userdata('uid') == $task['owner']) ): ?>
				<a href="<?=base_url()?>task/delete_c/<?=$note['noteid']?>" data-ajax="false" style="text-decoration: none">( - )</a>
				<?php endif; ?>
			</span>
		<p class="note">
			<?=$note['note']?>
			<span style="display:block;text-align:right;font-size: 10pt;"><?=reverse_datetime($note['submitted'])?></span>
		</p>

	<?php endforeach; ?>

	<?php if($task['completed'] == 0): ?>

	<h3>Add A Note</h3>
	<form action="<?php echo base_url();?>task/comment" method="post" data-ajax="false">
		<label for="notes">Notes</label>
		<textarea id="notes" name="notes"></textarea>
		<label for="asset">Add a File</label>
		<input type="file" name="asset" id="asset" />
		<input type="hidden" name="taskid" id="taskid" value="<?php echo $task['id'] ?>" />
		<input type="hidden" name="redirect" id="redirect" value="<?php echo current_url(); ?>" />
		<input type="submit" name="submit" id="submit" value="Submit" />
	</form>

	<?php endif; ?>

	<?php if( ($task['access'] == 3) and ($this->session->userdata('uid') != $task['owner']) ): ?>
	<p>
		Is this public task inappriopriate, or seem to break site rules?
		<a href="<?=base_url()?>task/report/<?=$task['id']?>" data-role="button" data-ajax="false">Report this Task</a>
	</p>
	<?php endif; ?>
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


<div data-role="popup" id="complete" data-overlay-theme="a" data-theme="c" data-dismissible="false" style="max-width:400px;" class="ui-corner-all">
    <div data-role="header" data-theme="a" class="ui-corner-top">
        <h1>Complete Task?</h1>
    </div>
    <div data-theme="d" class="ui-corner-bottom ui-content">
        <h3 class="ui-title">You sure this task is complete?</h3>
        <p>This'll finalize the task for all participants.</p>
        <a href="#" data-role="button" data-inline="true" data-rel="back" data-theme="c">Cancel</a>
        <a href="<?=base_url();?>task/complete/<?=$task['id']?>" data-role="button" data-ajax="false" data-inline="true" data-transition="flow" data-theme="b">Complete</a>
    </div>
</div>