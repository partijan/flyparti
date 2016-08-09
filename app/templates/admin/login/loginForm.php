<?php //echo getHash('heslo'); ?>
<div class="box">
	<h1>Prihlášení</h1>
	<?php switch ($result) {
		case 'notAuthorized': ?>
			<p class="warning result-box">Litujeme, ale přihlašovací jméno a heslo nesouhlasí.</p>

			<?php break;
		case 'error': ?>
			<p class="warning result-box">Při odesílání došlo k chybě na serveru. Omlouváme se, zkuste to prosím později znovu.</p>

			<?php break;
		default:
			break;
	}
	?>
	<form action="?" method="post">

		<p class="form-pair">
			<label for="username">Přihlašovací jméno</label>
			<input type="text" name="username" id="username" value="<?php echo getArrayValue($values, 'username') ?>" />
			<b class="warning"><?php echo getArrayValue($errors, 'username') ?></b>
		</p>

		<p class="form-pair">
			<label for="password">Přihlašovací heslo</label>
			<input type="password" name="password" id="password" value="<?php echo getArrayValue($values, 'password') ?>" />
			<b class="warning"><?php echo getArrayValue($errors, 'password') ?></b>
        </p>

		<p>
		<input type="submit" value="Odeslat" />
		</p>
       <a href="../index.php">Home</a>
	</form>
</div>