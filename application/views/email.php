<div class="content">
<h2>Send a Newsletter</h2>
<form action="<?=base_url()?>admin/email" method="post" data-ajax="false">
<label for="subject">Email Subject</label>
<input type="text" name="subject" id="subject" />
<label for="body">Email Body</label>
<textarea name="body" id="body"></textarea>
<p>This email is going to <?=$members?> members</p>
<input type="submit" value="Email Newsletter" />
</form>
</div>