<style>
#nav-btn { display: none; }
#back-btn { display: block; }
</style>
	<div class="content">
		<form>
			<label for="title">Title</label>
				<input type="text" id="title" name="title" />
			<label for="notes">Notes</label>
				<textarea></textarea>

			<a href="#" data-role="button" data-inline="true">Pick A Time?</a>
				<span class="time-display"></span>
			<label for="is-due">Due Date?</label>
				<select name="is-due" id="is-due" data-role="slider">
	    			<option value="off" selected="">No</option>
	    			<option value="on">Yes</option>
				</select>
			<div id="due-hide">
				<label for="duedate">Due Date</label>
				<input type="date" name="duedate" id="duedate" value="">
			</div>

			<fieldset data-role="controlgroup" data-type="horizontal" data-mini="false">
		    <legend>Want to share this list?</legend>
		        <input type="radio" name="radio-choice-b" id="radio-choice-c" value="list" checked="checked">
		        <label for="radio-choice-c">Private</label>
		        <input type="radio" name="radio-choice-b" id="radio-choice-d" value="grid">
		        <label for="radio-choice-d">Groups</label>
		        <input type="radio" name="radio-choice-b" id="radio-choice-e" value="gallery">
		        <label for="radio-choice-e">Public</label>
			</fieldset>
			<p>
				<input type="submit" name="addtask" id="addtask" value="Add Task" />
			</p>
		</form>
	</div><!-- /content -->

	<style>#due-hide { display:none;}</style>
	<script>
	$('#is-due').change(function(){
		var dueswitch = $(this);
		var show = dueswitch[0].selectedIndex == 1 ? true:false;
		$('#due-hide').toggle(show);
	})
	</script>