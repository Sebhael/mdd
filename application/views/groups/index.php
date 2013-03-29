<div class="content">
<h2>Your Groups</h2>
<ul data-role="listview" data-inset="true">
<?php foreach($stuff as $group): ?>
<li><a href="#"> <?=$group['name']?> </a></li>
<?php endforeach; ?>
</ul>
</div>