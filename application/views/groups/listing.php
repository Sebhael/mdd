<div class="content">
<h2><?=$group[0]['name']?></h2>
<ul data-role="listview" data-inset="true">
	<?php foreach($group as $g => $v): ?>

		<li>
			<?=$v['name']?>
			<?php if($v['owner'] == $this->session->userdata('uid')):?>
			<span style="float:right">OWNER!</span>
			<?php endif; ?>
		</li>
	
	<?php endforeach; ?>
	<li><a href="<?=base_url()?>groups/memberadd/">Add a new member!</a></li>
</ul>
<?php print_r($group); ?>
</div>