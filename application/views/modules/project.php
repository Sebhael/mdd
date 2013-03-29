<h3 style="padding:0; margin: 0;">Related Tasks</h2>
<ul data-role="listview" data-inset="true" data-mini="true" id="sb">
	<?php foreach($pro_mod as $project): ?>
	<li>
		<a href="<?=base_url()?>task/listing/<?=$project['owner']?>/<?=$project['slug']?>">
			<?=$project['title']?>
		</a>
	</li>
	<?php endforeach; ?>
</ul>
