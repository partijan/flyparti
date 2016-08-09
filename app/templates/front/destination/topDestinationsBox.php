<div class="box" id="top-list">
	<h2>Seznam nejoblibenejsich destinaci</h2>
	<ul>
		<?php foreach($destinations as $destination) { ?>
			<li><a href="destinace.php?idDestinace=<?php echo $destination['id'] ?>"><?php echo $destination['title'] ?></a></li>
		<?php } ?>
	</ul>
	
</div>
