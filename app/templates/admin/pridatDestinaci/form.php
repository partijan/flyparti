<div class="box">
    <h1>Přidat novou destinaci</h1>

    <?php
    switch ($result)
    {
        case 'success':
            ?>
            <p class="success result-box">Nová destinace byla úspěšně vytvořena.</p>

            <?php
            break;
        case 'errors':
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
            <label for="title">Název destinace</label>
            <input type="text" name="title" id="title" value="<?php echo getArrayValue($values, 'title') ?>" placeholder="Praha-Dublin" />
            <b class="warning"><?php echo getArrayValue($errors, 'title') ?></b>
        </p>
		
		<p class="form-pair">
            <label for="continent_id">Kontinent</label>
            <select name="continent_id">
				<option value="">- - -</option>
			<?php foreach ($values['continents'] as $continent) { 
				$selected = $continent['id'] == getArrayValue($values, 'continent_id') ? ' selected="selected"' : '';
				?>
				<option value="<?php echo $continent['id']; ?>"<?php echo $selected; ?>><?php echo $continent['title']; ?></option>
			<?php } ?>
            </select>             
            <b class="warning"><?php echo getArrayValue($errors, 'continent_id') ?></b>
        </p>
		
        <p class="form-pair">
            <label for="dtValidFrom">Platnost od</label>
            <input type="text" name="dtValidFrom" id="dtValidFrom" value="<?php echo getArrayValue($values, 'dtValidFrom') ?>" placeholder="20. 10. 2022" />
            <b class="warning"><?php echo getArrayValue($errors, 'dtValidFrom') ?></b>
        </p>
        
        <p class="form-pair">
            <label for="dtValidTo">Platnost do</label>
            <input type="text" name="dtValidTo" id="dtValidTo" value="<?php echo getArrayValue($values, 'dtValidTo') ?>" placeholder="20. 10. 2022" />
            <b class="warning"><?php echo getArrayValue($errors, 'dtValidTo') ?></b>
        </p>
        
        <p class="form-pair">
            <label for="description">Popis destinace</label>
            <textarea id="text"  name="description" style="width: 800px; height: 150px"><?php echo getArrayValue($values, 'description') ?></textarea>
            <b class="warning"><?php echo getArrayValue($errors, 'description') ?></b>
        </p>
        <p class="form-pair">
            <label for="briefDescription">Krátky popis</label>
            <textarea id="text"  name="briefDescription" style="width: 400px; height: 75px"><?php echo getArrayValue($values, 'briefDescription') ?></textarea>
            <b class="warning"><?php echo getArrayValue($errors, 'briefDescription') ?></b>
        </p>
        <p class="form-pair">
            <label for="catering">Stravování</label>
            <textarea id="text"  name="catering" style="width: 800px; height: 150px"><?php echo getArrayValue($values, 'catering') ?></textarea>
            <b class="warning"><?php echo getArrayValue($errors, 'catering') ?></b>
        </p>
        <p class="form-pair">
            <label for="accommodation">Popis Ubytováni</label>
            <textarea id="text"  name="accommodation" style="width: 800px; height: 150px"><?php echo getArrayValue($values, 'accommodation') ?></textarea>
            <b class="warning"><?php echo getArrayValue($errors, 'accommodation') ?></b>
        </p>
        <p class="form-pair">
            <label for="note">Krátka poznámka</label>
            <textarea id="text"  name="note" style="width: 400px; height: 75px"><?php echo getArrayValue($values, 'note') ?></textarea>
            <b class="warning"><?php echo getArrayValue($errors, 'note') ?></b>
        </p>
        <p class="form-pair">
            <label for="returnPrice">Cena zpátečné letenky</label>
            <input type="number" name="returnPrice" id="returnPrice" value="<?php echo getArrayValue($values, 'returnPrice') ?>" placeholder="" />
            <b class="warning"><?php echo getArrayValue($errors, 'returnPrice') ?></b>
        </p>
        <p class="form-pair">
            <label for="oneWayPrice">Cena jednosmerný letenky</label>
            <input type="number" name="oneWayPrice" id="oneWayPrice" value="<?php echo getArrayValue($values, 'oneWayPrice') ?>" placeholder="" />
            <b class="warning"><?php echo getArrayValue($errors, 'oneWayPrice') ?></b>
        </p>
        <p>
            <input type="submit" value="Vytvořit" />
        </p>
        <input type="hidden" name="id" value="<?php echo getArrayValue($values, 'id') ?>" />

    </form>
</div>