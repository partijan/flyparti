<div class="box">
    
	<h1><?php echo $title ?></h1>
                   <a href="objednavka-destinace.php?idDestinace=<?php echo $id ?>">Rezervace letenky</a>

	<h5><?php echo $briefDescription ?></h5>
	
	<h2>Charakteristika destinace</h2>
	<?php echo $description ?>
        
	<h2>Stravování a kuchyně</h2>
	<?php echo $catering ?>

	<h2>Ubytovani</h2>
	<?php echo $accommodation ?>

	<h2>Aktuální ceny</h2>

	<dl>                        
		<dt>Cena jednosměrná</dt>
		<dd><?php echo number_format ($oneWayPrice, 0, '', ' ');  ?>,- Kč</dd>

		<dt>Cena zpáteční</dt>
		<dd><?php echo number_format ($returnPrice, 0, '', ' ');  ?>,- Kč</dd>
                
                
		<?php if (strlen($discountDescription) > 0 && strlen($discountPrice)) { ?>
		
		<dt><?php echo $discountDescription ?></dt>
		<dd><?php echo $discountPrice ?>,- Kč</dd>
               		
		<?php } ?>
	</dl>
        <a href="objednavka-destinace.php?idDestinace=<?php echo $id ?>">Rezervace letenky</a>
</div>
