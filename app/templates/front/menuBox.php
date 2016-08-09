<ul>
	<?php foreach($menuItems as $page => $title) { ?>
		<li<?php echo $page == $currentPage ? ' class="act"' : '' ?>><a href="<?php echo $page ?>"><?php echo $title ?></a></li>
	<?php } ?>
</ul>