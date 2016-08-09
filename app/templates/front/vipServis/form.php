<div class="box">
	<h1>VIP servis</h1>

	<?php switch ($result) {
		case 'success': ?>
			<p class="success result-box">Děkujeme, váš požadavek byl zaregistrován. V nejbližší době vás budeme kontaktovat.</p>

			<?php break;
		case 'error': ?>
			<p class="warning result-box">Při odesílání došlo k chybě na serveru. Omlouváme se, zkuste to prosím později znovu.</p>

			<?php break;
		default:
			break;
	}
	?>

	<form action="?" method="post" id="form-vip-servis">

		<p class="form-pair">
			<label for="name">Jméno a příjmení:</label>
			<input type="text" name="name" id="name" value="<?php echo getArrayValue($values, 'name') ?>" placeholder="Jan Novák" />	
			<b class="warning"><?php echo getArrayValue($errors, 'name') ?></b>
		</p>

		<p class="form-pair">
			<label for="email">E-mail:</label>
			<input type="text" name="email" id="email" value="<?php echo getArrayValue($values, 'email') ?>" placeholder="jan@novak.cz" />
			<b class="warning"><?php echo getArrayValue($errors, 'email') ?></b>
		</p>

		<p class="form-pair">
			<label for="message">Text</label>
			<textarea id="message" class="w-m" name="message"><?php echo getArrayValue($values, 'message') ?></textarea>
			<b class="warning"><?php echo getArrayValue($errors, 'message') ?></b>
		</p>

		<p>
		<input type="submit" value="Odeslat" />
		</p>

	</form>
</div>