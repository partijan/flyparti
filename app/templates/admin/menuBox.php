<h2><?php //echo $nadpis; ?></h2>
<p class="user-info">Přihlášen: <?php echo getUserData('firstname') . ' ' . getUserData('surname'); ?> </p>
<ul>
	<?php foreach($menuItems as $page => $title) { ?>
		<li<?php echo $page == $currentPage ? ' class="act"' : '' ?>><a href="<?php echo $page ?>"><?php echo $title ?></a></li>
	<?php } ?>
</ul>