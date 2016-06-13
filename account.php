<?php
//index.php
//startscherm van de webwinkel

$page_title = 'Welkom in de WebWinkel';
include ('includes/header.html');

// mysqli_connect.php bevat de inloggegevens voor de database.
// Per server is er een apart inlogbestand - localhost vs. remote server

// Page header:
echo '<div class="panel-footer"></div>';
echo '<h3>Uw gegevens</h3>';

//
		$conn = mysqli_connect('', '', '', '-DB');
// check connection
if (mysqli_connect_errno()) {
	printf("<p><b>Fout: verbinding met de database mislukt.</b><br/>\n%s</p>\n", mysqli_connect_error());
	include ('includes/footer.html');
	exit();
}

if (empty($_SESSION['KlantNr'])) {

	echo "<p><h5>U bent niet ingelogd. Klik <a href = 'http://buitenlandseproducten.nl/login.php'>hier</a> om in te loggen of een account aan te maken.</h5><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br></p>\n";
} else {
	$klantnr = $_SESSION['KlantNr'];

	$sql = "SELECT `Klantnaam`, `Adres`, `Postcode`, `Plaats`, `Mail` FROM `KLANT` WHERE `Klantnr`='".$klantnr."'";
	// Voer de query uit en sla het resultaat op 

$naam = 


	$result = mysqli_query($conn, $sql) or die (mysqli_error($conn)."<br>Error in file ".__FILE__." on line ".__LINE__);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        echo"<br><br><br>\n";
	echo"<center><div class='container'>\n";
        
	echo "<table class='table table-hover'>\n";
	echo "<tr><td id='links'>Naam</td> <td id='rechts'>".$row["Klantnaam"]."</td></tr>\n";
	echo "<tr><td id='links'>Adres</td><td id='rechts'>".$row["Adres"]."</td></tr>\n";
	echo "<tr><td id='links'>Postcode</td><td id='rechts'>".$row["Postcode"]."</td></tr>\n";
	echo "<tr><td id='links'>Plaats</td><td id='rechts'>".$row["Plaats"]."</td></tr>\n";
	echo "<tr><td id='links'>Email</td><td id='rechts'>".$row["Mail"]."</td></tr>\n";
	echo "<tr><td id='links'>Klantnr</td><td id='rechts'>".$klantnr."</td></tr>\n";
	echo "</table>\n";
        echo "</div>";
        echo"<br><br><br><br><br><br><br><br><br><br><br><br><br><br>\n";
}
echo '<div class="panel-footer"></div>';
// Sluit de connection
mysqli_close($conn);
include ('includes/footer.html');
?>