<!DOCTYPE html>
<html>
<head>
    <title>Praha - Bratislava | Flyparti - letecká společnost</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <?php require 'header-css.php'; ?>
    <link rel="stylesheet" type="text/css" href="css/detail.css?ref=<?php echo CSS_REFRESH; ?>"/>

</head>
<body>
    <div id="page-wrapper">
        <div id="page">
            <div id="header">
                <h1><a href="<?php echo URL_HOMAPAGE; ?>"> Praha - Bratislava</a></h1>
                <h2><a href="ObjednavkaBratislava.php">Rezervace letenky</a></h2>
                <form action="?" method="post"></form>

            </div>

            <div id="content-wrapper">
                <div class="box">
                    <h2>Zavazna rezervace</h2>
                    <fieldset>
                        <legend>Objednávka letu: Praha - Bratisalva</legend>
                    <p>
                        <label class="left" for="firstname">Jmeno</label><br/>
                        <input type="text" name="firstname" id="firstname"/>
                    </p>
                    <p>
                        <label class="left" for="prijmeni">Prijmeni</label><br/>
                        <input type="text" name="prijmnei" id="prijmeni"/>
                    </p>
                    <p>
                        <label class="left" for="adresa">Adresa</label><br/>
                        <input type="text" name="adresa" id="adresa"/>
                    </p>
                    <p>
                        <label class="left" for="mesto">Mesto</label><br/>
                        <input type="text" name="mesto" id="mesto"/>
                    </p>
                    <p>
                        <label class="left" for="stat">Stat</label><br/>
                        <input type="text" name="stat" id="stat"/>
                    </p>
                    <p>
                        <label class="left" for="email">Email</label><br/>
                        <input type="text" name="email" id="email"/>
                    </p>
                    <p>
                        <label class="left" for="mobil">Mobil</label><br/>
                        <input type="text" name="mobil" id="mobil"/> 
                    </p> 
                    <p>
                        <label class="left" for="pocet_zavazadel">Pocet zavazadel</label><br/>
			<input type="text" name="cislo" id="pocet_zavazadel"/>						<select>
                                                                        <option value="">- -</option>
                                                                        <option value="1">1</option>
                                                                         <option value="2">2</option>
                                                                         <option value="3">3</option>
                                                                         <option value="4">4</option>
                                                                         </select>   
                    </p>
                        <p>
                        <label class="left" for="pocet_osob">Pocet osob</label><br/>
			<input type="text" name="cislo" id="pocet_osob"/>						
                                                                       <select>
                                                                         <option value="1">1</option>
                                                                         <option value="2">2</option>
                                                                         <option value="3">3</option>
                                                                         <option value="4">4</option>
                                                                         <option value="5">5</option>
                                                                         <option value="6">6</option>
                                                                         <option value="7">7</option>
                                                                         <option value="8">8</option>
                                                                         <option value="9">9</option>
                                                                         <option value="10">10</option>
                                                                         </select>   
                    </p>
                     <p>
			<label class="left" for="datum_odletu">Datum Odletu</label><br/>
                        <input type="text" name="cislo" id="datum_odletu"/>
									<select name="day">
								</p>
                     <p>
		     <label class="left" for="datum_priletu">Datum Priletu</label><br/>
                     <input type="text" name="cislo" id="datum_priletu"/>
									<select name="day">
	                                                              
								</p>
                    <p>
		<label class="left" for="spusob_platby">Spusob platby</label><br/>
                <input type="text" name="cislo" id="spusob_platby"/>
                                                                        <select name="spusob platby">
                                                                           
                                                                            <option value="Kreditni kartou">Kreditni kartou</option>
                                                                                <option value="Na prepaske v hotovosti">Na prepaske v hotovosti</option>
                                                                                 <option value="Prevodem na ucet">Prevodem na ucet</option>  
                                                                        </select>
								</p>
                    	<p>
									<input type="submit" value="objednat" />

								</p>
                    </fieldset>
                    </div>
            </div>

            <div id="side-wrapper">
                <div class="box">
                    <div class="image-list">
                        <img src="Obrazky/slvlajka.jpg" width="220" alt="slvlajka" />
                        <img src="Obrazky/slove7.jpg" width="200"  alt="obrazek" />
                        <img src="Obrazky/slove1.jpg" width="200"  alt="obrazek" />
                        
                        <img src="Obrazky/slove6.jpg" width="200" alt="obrazek" />
                        <img src="Obrazky/slove4.jpg" width="200"  alt="obrazek" />
                        <img src="Obrazky/slove.jpg" width="200"  alt="obrazek" />
                        <img src="Obrazky/slove5.jpg" width="200"  alt="obrazek" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
