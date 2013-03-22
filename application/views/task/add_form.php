<style>
#nav-btn { display: none; }
#back-btn { display: block; }
#due-hide { display:none;}
</style>
	<div class="content">
		<form action="<?=base_url();?>task/process" method="post" data-ajax="false">
			<label for="title">Title</label>
				<input type="text" id="title" name="title" />
			<label for="notes">Notes</label>
				<textarea name="notes" id="notes"></textarea>
			<a href="#" data-role="button" data-inline="true">Pick A Time?</a>
				<span class="time-display"></span>
			<label for="is-due">Due Date?</label>
				<select name="is-due" id="is-due" data-role="slider">
	    			<option value="no" selected="">No</option>
	    			<option value="yes">Yes</option>
				</select>
			<div id="due-hide">
				<label for="duedate">Due Date</label>
				<input type="date" name="duedate" id="duedate" value="">
			</div>

			<fieldset data-role="controlgroup" data-type="horizontal" data-mini="false">
		    <legend>Want to share this list?</legend>
		        <input type="radio" name="access" id="access-pri" value="1" checked="checked">
		        <label for="access-pri">Private</label>
		        <input type="radio" name="access" id="access-grp" value="2">
		        <label for="access-grp">Groups</label>
		        <input type="radio" name="access" id="access-pub" value="3">
		        <label for="access-pub">Public</label>
			</fieldset>
			<p>
				<input type="submit" name="addtask" id="addtask" value="Add Task" />
			</p>
		</form>
	</div><!-- /content -->

	<script>
	$('#is-due').change(function(){
		var dueswitch = $(this);
		var show = dueswitch[0].selectedIndex == 1 ? true:false;
		$('#due-hide').toggle(show);
	});
	</script>