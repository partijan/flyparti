<div class="box">
    <h1>Editace destinaci</h1>

	<?php
	switch ($result)
	{
		case 'success':
			?>
			<p class="success result-box">Děkujeme,destinace byla editivana.</p>

			<?php
			break;
		case 'error':
			?>
			<p class="warning result-box">Při odesílání došlo k chybě na serveru. Omlouváme se, zkuste to prosím později znovu.</p>

			<?php
			break;
		default:
			break;
	}
	?>

    <form action="?" method="post" id="form">

		<p class="form-pair">
            <label for="title">Název destinace:</label>
			<textarea id="title"  name="title" ><?php echo getArrayValue($values, 'title') ?></textarea>
			<b class="warning"><?php echo getArrayValue($errors, 'title') ?></b>
        </p>
		
		<p class="form-pair">
            <label for="continent_id">Kontinent</label>
            <select name="continent_id">
				<option value="">- - -</option>
			<?php foreach ($continents as $continent) { 
				$selected = $continent['id'] == getArrayValue($values, 'continent_id') ? ' selected="selected"' : '';
				?>
				<option value="<?php echo $continent['id']; ?>"<?php echo $selected; ?>><?php echo $continent['title']; ?></option>
			<?php } ?>
            </select>             
            <b class="warning"><?php echo getArrayValue($errors, 'continent_id') ?></b>
        </p>
		
        <p class="form-pair">
            <label for="dtValidFrom">Platnost od:</label>
            <input type="text" name="dtValidFrom" id="dtValidFrom" value="<?php echo getArrayValue($values, 'dtValidFrom') ?>" placeholder="" />	
            <b class="warning"><?php echo getArrayValue($errors, 'dtValidFrom') ?></b>
        </p>
		
        <p class="form-pair">
            <label for="dtValidTo">Platnost do:</label>
            <input type="text" name="dtValidTo" id="dtValidTo" value="<?php echo getArrayValue($values, 'dtValidTo') ?>" placeholder="" />	
            <b class="warning"><?php echo getArrayValue($errors, 'dtValidTo') ?></b>
        </p>		
        
        <p class="form-pair">
            <label for="description">Popis destinece:</label>
			<textarea id="description"  name="description" style="width: 823px; height: 150px"><?php echo getArrayValue($values, 'description') ?></textarea>
            <b class="warning"><?php echo getArrayValue($errors, 'description') ?></b>
        </p>
		
        <p class="form-pair">
            <label for="briefDescription">Krátky popis:</label>
            <textarea id="text"  name="briefDescription" style="width: 400px; height: 75px"><?php echo getArrayValue($values, 'briefDescription') ?></textarea>
            <b class="warning"><?php echo getArrayValue($errors, 'briefDescription') ?></b>
        </p>

        <p class="form-pair">
            <label for="catering">Jídlo:</label>
			<textarea id="catering"  name="catering" style="width: 823px; height: 150px"><?php echo getArrayValue($values, 'catering') ?></textarea>
            <b class="warning"><?php echo getArrayValue($errors, 'catering') ?></b>
        </p>

        <p class="form-pair">
            <label for="accommodation">Ubytování:</label>
			<textarea id="accommodation"  name="accommodation" style="width: 823px; height: 150px"><?php echo getArrayValue($values, 'accommodation') ?></textarea>
            <b class="warning"><?php echo getArrayValue($errors, 'accommodation') ?></b>
        </p>
		
        <p class="form-pair">
            <label for="returnPrice">Zpatečný letenka:</label>
            <input type="number" name="returnPrice" id="returnPrice" value="<?php echo getArrayValue($values, 'returnPrice') ?>" placeholder="" />
            <b class="warning"><?php echo getArrayValue($errors, 'returnPrice') ?></b>
        </p>
		
        <p class="form-pair">
            <label for="oneWayPrice">Jednosměrná letenka:</label>
            <input type="number" name="oneWayPrice" id="oneWayPrice" value="<?php echo getArrayValue($values, 'oneWayPrice') ?>" placeholder="" />
            <b class="warning"><?php echo getArrayValue($errors, 'oneWayPrice') ?></b>
        </p>
		
        <p>
            <input type="submit" value="Vyřízeno" />
        </p>
        <input type="hidden" name="id" value="<?php echo getArrayValue($values, 'id') ?>" />

    </form>
</div>