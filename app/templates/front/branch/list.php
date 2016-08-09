<div class="box">
    <h1>Kontakty našich poboček</h1>
    <?php foreach ($branches as $branch)
    { ?>
        <address>	
            <h2><?php echo $branch['city']; ?></h2>
            <dl>
                <dt>Adresa</dt>
                <dd><?php echo $branch['address']; ?></dd>

                <dt>Kontaktní osoba</dt>
                <dd><?php echo $branch['namePersonContact']; ?></dd>

                <dt>Telefon</dt>
                <dd><?php echo $branch['phone']; ?></dd>
            </dl>
        </address>
<?php } ?>
</div>