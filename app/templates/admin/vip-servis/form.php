<div class="box">
	<h1>VIP servis</h1>

	<?php switch ($result) {
		case 'success': ?>
			<p class="success result-box">Děkujeme váš pozadevek jsem prijaly.Náš zamněstnanec vás bude kontaktovat.</p>

			<?php break;
		case 'error': ?>
			<p class="warning result-box">Pri odesílani požadavku došlo k chby zkuste to pozdeji.Děkuji.</p>

			<?php break;
		default:
			break;
	}
	?>

	<form action="?" method="post" id="form-vip-servis">

		<p class="form-pair">
			<label for="name">Jmeno a přijmneni:</label>
			<input type="text" name="name" id="name" value="<?php echo getArrayValue($values, 'name') ?>" placeholder="Jan Nov�k" />	
			<b class="warning"><?php echo getArrayValue($errors, 'name') ?></b>
		</p>

		<p class="form-pair">
			<label for="email">E-mail:</label>
			<input type="text" name="email" id="email" value="<?php echo getArrayValue($values, 'email') ?>" placeholder="jan@novak.cz" />
			<b class="warning"><?php echo getArrayValue($errors, 'email') ?></b>
		</p>

		<p class="form-pair">
			<label for="message">Text</label>
			<textarea id="message" class="w-m" name="text"><?php echo getArrayValue($values, 'text') ?></textarea>
			<b class="warning"><?php echo getArrayValue($errors, 'text') ?></b>
		</p>

		<p>
		<input type="submit" value="Odeslat" />
		</p>
        <input type="hidden" name="id" value="<?php echo getArrayValue($values, 'id') ?>" />

	</form>
</div>