<?php
//index.php
//startscherm van de webwinkel

$page_title = 'Welkom in de WebWinkel';
include ('includes/header.html');

// mysqli_connect.php bevat de inloggegevens voor de database.
// Per server is er een apart inlogbestand - localhost vs. remote server
// 
// Stap 1: maak verbinding met MySQL.
// Zorg ervoor dat MySQL (via XAMPP) gestart is.
//
$conn = mysqli_connect('localhost', 'WebwinkelF4', 'groepf4', 'webwinkel-DB');
 
// check connection
if (mysqli_connect_errno()) {
	printf("<p><b>Fout: verbinding met de database mislukt.</b><br/>\n%s</p>\n", mysqli_connect_error());
	include ('includes/footer.html');
	exit();
}

// Deze pagina toont zelf de foutmeldingen wanneer een van de velden
// in het formulier niet juist is ingevuld. De volgende code
// toont deze meldingen.
if ( $_SERVER['REQUEST_METHOD'] == 'POST' &&
	isset($_POST['name'], $_POST['mail'], $_POST['password'], $_POST['adres'], $_POST['towncity'], $_POST['postcode']) )
{
	// We gaan de errors in een array bijhouden
	// We kunnen dan alle foutmeldingen in een keer afdrukken.
	$aErrors = array();

	//  Een naam bevat letters en spaties (minimaal 3)
	if ( !isset($_POST['name']) or !preg_match( '~^[\w ]{3,}$~', $_POST['name'] ) ) {
		$aErrors['name'] = 'Uw naam is niet juist ingevuld';
	}

	//  Een mail-adres is wat ingewikkelder
	if ( !isset($_POST['mail']) or !preg_match( '~^[a-z0-9][a-z0-9_.\-]*@([a-z0-9]+\.)*[a-z0-9][a-z0-9\-]+\.([a-z]{2,6})$~i', $_POST['mail'] ) ) {
		$aErrors['mail'] = 'Het e-mail addres is onjuist.';
	}

	//  Een adres heeft letters, cijfers, spaties (minimaal 5)
	if ( !isset($_POST['adres']) or !preg_match( '~^[\w\d ]{5,}$~', $_POST['adres'] ) ) {
		$aErrors['adres'] = 'Het adres is onjuist.';
	}

	//  Een plaatsnaam heeft letters, spaties en misschien een apostrof
	if ( !isset($_POST['towncity']) or !preg_match( '~^[\w\d\' ]*$~', $_POST['towncity'] ) ) {
		$aErrors['towncity'] = 'De stad is onjuist';
	}

	//  Een postcode heeft vier cijfers, eventueel een spatie, en twee cijfers
	if ( !isset($_POST['postcode']) or !preg_match( '~^\d{4} ?[a-zA-Z]{2}$~', $_POST['postcode'] ) ) {
		$aErrors['postcode'] = 'De postcode is onjuist';
	}
	
	// wachtwoord (minimaal 3)
	// if ( !isset($_POST['password']) or !preg_match( '~^[\w ]{3,}$~', $_POST['password'] ) ) {
	// 	$aErrors['password'] = 'Geen password ingevuld.';
	// }

	if ( count($aErrors) == 0 ) 
	{
		// Gebruiker in database registreren.
		$conn = mysqli_connect('localhost', 'WebwinkelF4', 'groepf4', 'webwinkel-DB');
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
		}

		$sql = "INSERT INTO `KLANT` (`Klantnaam`, `Adres`, `Postcode`, `Plaats`, `Mail`, `Klantww`) VALUES ".
				"('".$_POST['name']."', '".$_POST['adres']."', '".$_POST['postcode']."', '".$_POST['towncity']."', '".$_POST['mail']."', '".$_POST['password']."');";

		// Voer de query uit en vang fouten op 
		if( !mysqli_query($conn, $sql) ) {
			$aErrors['mail'] = 'Registratie mislukt, mail adres bestaat al.';
		} else {
			// Met myslqi_insert_id krijg je de id van het autoincrement veld terug - het klantnr.
			$klantnr = mysqli_insert_id($conn); 
			
			$_SESSION['Klantnr'] = $klantnr;
			$_SESSION['Klantnaam'] = $_POST["name"];
		
			// Sluit de connection
			mysqli_close($conn);

			header('Location: login.php');
			exit();
		}
	}
}
?><div class="panel-footer"></div>

<div class="container">
<form action="registreer.php" method="post" class="formulier" style="margin:0px 200px 0px 200px;">
  <?php
  if ( isset($aErrors) and count($aErrors) > 0 ) {
		print '<ul class="errorlist">';
		foreach ( $aErrors as $error ) {
			print '<li>' . $error . '</li>';
		}
		print '</ul>';
  }
  ?>

<h3>Registreer</h3>



  <p><h5>Vul het onderstaande formulier in. Velden met een <em>*</em> zijn verplicht.</h5></p>
<center>
	<legend>Uw gegevens</legend>
	<ul>
	  <?php echo isset($aErrors['name']) ? '<li class="error">' : '<li>' ?>
		<label for="name"><h5>Naam<em> *</em></h5></label>
		<input class="form-control" id="name" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>" />
	  </li>
	  <?php echo isset($aErrors['mail']) ? '<li class="error">' : '<li>' ?>
		<label for="mail"><h5>E-mail<em> *</em></h5></label>
		<input class="form-control" id="mail" name="mail" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" />
	  </li>
	  <?php echo isset($aErrors['adres']) ? '<li class="error">' : '<li>' ?>
		<label for="adres"><h5>Adres<em> *</em></h5></label>
		<input class="form-control" id="adres" name="adres" value="<?php echo isset($_POST['adres']) ? htmlspecialchars($_POST['adres']) : '' ?>" />
	  </li>
	  <?php echo isset($aErrors['postcode']) ? '<li class="error">' : '<li>' ?>
		<label for="postcode"><h5>Postcode<em> *</em></h5></label>
		<input class="form-control" id="postcode" name="postcode" value="<?php echo isset($_POST['postcode']) ? htmlspecialchars($_POST['postcode']) : '' ?>" />
	  </li>
	  <?php echo isset($aErrors['towncity']) ? '<li class="error">' : '<li>' ?>
		<label for="towncity"><h5>Plaats</h5></label>
		<input class="form-control" id="towncity" name="towncity" value="<?php echo isset($_POST['towncity']) ? htmlspecialchars($_POST['towncity']) : '' ?>" />
	  </li>
	  <?php echo isset($aErrors['password']) ? '<li class="error">' : '<li>' ?>
		<label for="password"><h5>Password<em> *</em></h5></label>
		<input class="form-control" id="password" name="password" type="password" value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '' ?>" />
	  </li>
	</ul>
	<input type="submit" value="Verstuur" class="btn btn-primary button1"/>

</form>
</div>

<?php	
include ('includes/footer.html');
?>