<style>
#back-btn{display:block;}
.nested { background: #37322c; border-radius: 5px; }
img.avatar{ padding:5px; }
p.desc { width: 80%; float: right;}
</style>
<div class="content">
	<div class="nested">
		<strong><?=$member['username']?></strong> <br />
		<img width="100" class="avatar" src="<?=base_url()?>uploads/avatars/_default.png" />	
	</div>
</div>