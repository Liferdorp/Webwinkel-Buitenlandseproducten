<?php
//index.php
//startscherm van de webwinkel

// Zet het niveau van foutmeldingen zo dat warnings niet getoond worden.
error_reporting(E_ERROR | E_PARSE);

$page_title = 'Welkom in de WebWinkel';
include ('includes/header.html');

// mysqli_connect.php bevat de inloggegevens voor de database.
// Per server is er een apart inlogbestand - localhost vs. remote server
// Toon eventuele foutmeldingen.
if ( $_SERVER['REQUEST_METHOD'] == 'POST') // && isset($_POST['mail']) && isset($_POST['password']))
{
	// We gaan de errors in een array bijhouden
	// We kunnen dan alle foutmeldingen in één keer afdrukken.
	$aErrors = array();

	//  Kijk of een mail adres of wachtwoord is ingevoerd
	if ( empty($_POST['mail'])) {
		$aErrors['mail'] = 'Geen geldig E-mailadres.';
	}

	if ( empty($_POST['wachtwoord'])) {
		$aErrors['wachtwoord'] = 'Geen geldig wachtwoord';
	}

	// Wanneer er geen foutieve invoer is gaan we naar de database.
	if ( count($aErrors) == 0 ) 
	{
		// Gebruiker uit database lezen.

		$conn = mysqli_connect('', '', '', '-DB');
// check connection
if (mysqli_connect_errno()) {
	printf("<p><b>Fout: verbinding met de database mislukt.</b><br/>\n%s</p>\n", mysqli_connect_error());
	include ('includes/footer.html');
	exit();
}
		// Het wachtwoord en e-mail adres dat is ingevoerd wordt gecontroleerd.
		$sql = "SELECT `KlantNr`, `Klantnaam`, `Klantww` FROM `KLANT` WHERE `Mail`='".$_POST['mail']."' AND `Klantww` = '".$_POST['wachtwoord']."' ;";
		// Voer de query uit 
		$result = mysqli_query($conn, $sql) or die (mysqli_error($conn)."<br>in file ".__FILE__." on line ".__LINE__);
		
		if(mysqli_num_rows($result) == 0) {
			$aErrors['mail'] = 'Het mailadres of wachtwoord is niet gevonden.';
			unset($_POST['mail']);
		} else {
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

			// Bij een ingelogde gebruiker bewaren we de naam en het klantnr in de sessie.
			// Hiermee kunnen we de klantnaam op het scherm tonen, en de winkelwagen aan 
			// het juiste klantnr koppelen, zodat de bestelling later afgerond kan worden.
			$_SESSION['KlantNr'] = $row["KlantNr"];
			$_SESSION['Klantnaam'] = $row["Klantnaam"];
			// Sluit de connection
			mysqli_close($conn);

			header('Location: account.php');
			exit();
		}
	}
}
?>
<div class="panel-footer"></div>
<div class="container">

<div class="row">
<div class="col-sm-6">
<h3 style="margin-top:100px;"><strong>Voor het eerst in onze webwinkel?</strong></h3>
<h5>Welkom! Om te kunnen bestellen moet u geregistreerd zijn.</h5>
<a href="registreer.php"><button class="btn button1" type="button"><span>Registreer</span></button></a>
</div>

<div class="col-sm-6">
<h3  style="margin-top:100px;"><strong>Ik heb al een account.</strong></h3>


    <form action="login.php" method="post" class="formulier" style="margin:0px 20px 0px 20px;">
      <?php
      if ( isset($aErrors) and count($aErrors) > 0 ) {
			print '<ul class="errorlist">';
			foreach ( $aErrors as $error ) {
				print '<li>' . $error . '</li>';
			}
			print '</ul>';
      }
      ?>
<center>

        <legend><h5>Als u een account bij ons heeft, kunt u hieronder inloggen.</h5></legend>
        <ul>
          <li>
            <label for="mail"><h5>E-mailadres</h5></label>
            <input class="form-control" id="email" name="mail" value="<?php echo isset($_POST['mail']) ? htmlspecialchars($_POST['mail']) : '' ?>" type="text"/>
            <label for="password"><h5>Wachtwoord</h5></label>
            <input class="form-control"  id="email" name="wachtwoord" value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '' ?>" type="password" />
          </li>
        </ul>
     <input type="submit" value="Login" class="btn button1 btn-primary" style="margin-left:30px"/>

    </form>
<br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>


</div>

<?php	
	include ('includes/footer.html');
?>