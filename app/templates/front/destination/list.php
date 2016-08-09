<div class="box" id="top-list">
	<h1>Vyberte si kam s náma poletíte vaše sny naše práce...</h1>
	
	<p class="continent-list">
	<?php foreach($continents as $continent) { ?>
		<?php 
		if($continent['selected'] == '1') 
		{
			$selected = ' class="active"';
		}
		else
		{
			$selected = '';
		}
		?>
		<a href="?kontinent=<?php echo $continent['id']; ?>"<?php echo $selected; ?>><?php echo $continent['title']; ?></a> | 
	<?php } ?>
		<a href="?kontinent=vse">všechny</a>
	</p>
	
	<ul>
	
<?php foreach($destinations as $destination) { ?>
	<li>
		<a href="destinace.php?idDestinace=<?php echo $destination['id'] ?>"><?php echo $destination['title'] ?></a>
		<p><?php echo $destination['briefDescription'] ?></p>
	</li>
<?php } ?>
	</ul>
</div>