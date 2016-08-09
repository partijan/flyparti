<div class="box">
    <h1>Přidat referenci</h1>

    <?php
    switch ($result)
    {
        case 'success':
            ?>
            <p class="success result-box">Děkujeme, váše reference byla přidána.</p>

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
            <label for="destination_id">Destinace</label>
			<select name="destination_id" id="destination_id">
				<option value="0">- - -</option>
				<?php foreach ($destinations as $destination) { 
					$selected = $destination['id'] == getArrayValue($values, 'destination_id') ? ' selected="selected"' : '';
					?>
					<option value="<?php echo $destination['id']; ?>"<?php echo $selected; ?>><?php echo $destination['title']; ?></option>
				<?php } ?>
			</select>
            <b class="warning"><?php echo getArrayValue($errors, 'destination_id') ?></b>
        </p>
        <p class="form-pair">
            <label for="text">Text</label>
            <textarea id="text"  name="text"><?php echo getArrayValue($values, 'text') ?></textarea>
            <b class="warning"><?php echo getArrayValue($errors, 'text') ?></b>
        </p>
        <p class="form-pair">
            <label for="author">Jméno</label>
            <input type="text" name="author" id="author" value="<?php echo getArrayValue($values, 'author') ?>" placeholder="" />
            <b class="warning"><?php echo getArrayValue($errors, 'author') ?></b>
        </p>

        <p>
            <input type="submit" value="Vložit novou referenci" />
        </p>
        <input type="hidden" name="id" value="<?php echo getArrayValue($values, 'id') ?>" />

    </form>
</div>