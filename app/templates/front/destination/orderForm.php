<div class="box">
    <form action="objednavka-destinace.php" method="post" id="orderForm-objednavka-destinace">           
        <h1>Objednavka: <?php echo $destination['title'] ?></h1>	


        <fieldset>
            <legend>Závazná rezervace</legend>

            <table>
                <caption><label>Výběr letu</label></caption>
                <tr>
                    <th>Odlet</th>
                    <th>Přílet</th>
                    <th>Počet míst</th>
                    <th>Zvolit</th>
                </tr>

                <?php
                foreach ($flights as $flight)
                {
                    $dtDeparture = date_create($flight ['dtDeparture']);
                    $dtArrival = date_create($flight ['dtArrival']);
                    if (getArrayValue($values, 'idFlight') == $flight['id'])
                    {
                        $checked = ' checked="checked" ';
                    }
                    else
                    {
                        $checked = '';
                    }
                    ?>
                    <tr>
                        <td>
    <?php echo date_format($dtDeparture, 'j. n. Y H:i') ?>
                        </td>
                        <td>
    <?php echo date_format($dtArrival, 'j. n. Y H:i') ?>
                        </td>
                        <td>
    <?php echo $flight['numberOfSeats'] ?>
                        </td>
                        <td>
                            <input type="radio" name="idFlight" value="<?php echo $flight['id'] ?>"<?php echo $checked; ?> />
                        </td>
                    </tr>
<?php } ?>
            </table>

            <b class="warning"><?php echo getArrayValue($errors, 'idFlight') ?></b>

            <p class="ordeFrorm-pair">
                <label for="firstname">Jméno</label>
                <input type="text" name="firstname" id="firstname" value="<?php echo getArrayValue($values, 'firstname') ?>"placeholder="Jan" />
                <b class="warning"><?php echo getArrayValue($errors, 'firstname') ?></b>
            </p>

            <p class="ordeFrorm-pair">
                <label for="surname">Příjmení</label>
                <input type="text" name="surname" id="surname" value= "<?php echo getArrayValue($values, 'surname') ?>"placeholder="Novák" />
                <b class="warning"><?php echo getArrayValue($errors, 'surname') ?></b>
            </p>

            <p class="ordeFrorm-pair">
                <label for="address">Adresa (ulice a číslo popisné)</label>
                <input type="text" name="address"id="address" value= "<?php echo getArrayValue($values, 'address') ?>"placeholder="Ke hrádku 14" />
                <b class="warning"><?php echo getArrayValue($errors, 'address') ?></b>
            </p>

            <p class="ordeFrorm-pair">
                <label for="city">Město / obec</label>
                <input type="text" name="city" id="city" value= "<?php echo getArrayValue($values, 'city') ?>"placeholder="Praha" />
                <b class="warning"><?php echo getArrayValue($errors, 'city') ?></b>
            </p>

            <p class="ordeFrorm-pair">
                <label>Počet cestujícich</label>
                <select name="personCount">
                    <option value="">-- nevybráno</option>  
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <b class="warning"><?php echo getArrayValue($errors, 'personCount') ?></b>
            </p>

            <p class="ordeFrorm-pair">
                <label>Stát</label>
                <select name="state">
                    <option value="Česká republika">Česká republika</option>
                    <option value="Slovenská republika">Slovenská republika</option>
                </select>
            </p>

            <p class="ordeFrorm-pair">
                <label for="email">E-mail</label>
                <input type="text" name="email" id="email" value= "<?php echo getArrayValue($values, 'email') ?>" placeholder="jan@novak.cz"/>
                <b class="warning"><?php echo getArrayValue($errors, 'email') ?></b>
            </p>

            <p class="ordeFrorm-pair">
                <label for="phone">Telefon</label>
                <input type="text" name="phone" id="phone" value= "<?php echo getArrayValue($values, 'phone') ?>"placeholder="00420 666 777 555" />
                <b class="warning"><?php echo getArrayValue($errors, 'phone') ?></b>
            </p>

            <p>
                <input type="submit" value="odeslat rezervaci" />
            </p>

        </fieldset>
        <input type="hidden" name="idDestination" value="<?php echo $destination['id'] ?>" />

    </form>

</div>