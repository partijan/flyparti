<div class="box">
	<h1>Napsali o nás</h1>
	
<?php foreach($references as $reference) { ?>
	<h2><a href="destinace.php?idDestinace=<?php echo $reference['id'] ?>"><?php echo $reference['title']; ?></a></h2>
	<p><?php echo $reference['text']; ?></p>
	<p><?php echo $reference['author']; ?><span><?php echo $reference['dtCreated']; ?></span></p>
<?php } ?>
</div>