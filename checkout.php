<?php
// checkout.php
//
// Dit bestand zorgt ervoor dat de winkelwagen van de klant in een bestelling en één of meer
// bestelregels wordt opgenomen. Als dit gelukt is is de bestelling geregistreerd
// en de winkelwagen geleegd.


$page_title = 'Welkom bij Buitenlandseproducten.nl';
include ('includes/header.html');

// mysqli_connect.php bevat de inloggegevens voor de database.
// Per server is er een apart inlogbestand - localhost vs. remote server
include ('includes/mysqli_connect_'.$_SERVER['SERVER_NAME'].'.php');

// Page header:
echo '<div class="panel-footer"></div>';
echo '<h2>Bestelling afronden</h2>';

if (empty($_SESSION['KlantNr'])) {
    echo "<p><h5>U bent nog niet ingelogd. Log in om uw bestelling af te ronden.</h5></p>\n";
   echo "<a href='login.php'><button class='btn button1' type='button'><span>Log in</span></button></a>"; 
   echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
} else {

	// Afsluiten van bestelling en bestelregel opslaan in database

	//connectie maken met database webwinkel
$conn = mysqli_connect('localhost', 'WebwinkelF4', 'groepf4', 'webwinkel-DB');
	 
	// check connection
	if (mysqli_connect_errno()) {
		printf("<p><b>Fout: verbinding met de database mislukt.</b><br/>\n%s</p>\n", mysqli_connect_error());
		include ('includes/footer.html');
		exit();
	}

	// Stap 1, zet de order in de bestelling tabel
	// Een bestelling heeft ook een bestelnummer (autoincrement), besteldatum (huidige datum/tijd), 
	// en status (default: open).


	$sql = "INSERT INTO BESTELLING (`Kla_KlantNr`) VALUES ('".$_SESSION['KlantNr']."');"; 
	$result = mysqli_query($conn, $sql) or die (mysqli_error($conn)."<br>in file ".__FILE__." on line ".__LINE__);


	$bestelnr = mysqli_insert_id($conn); // insert_id geeft de id terug van het autoincrement veld - het bestelnr dus.

	// Stap 2, winkelwagen splitsen en de producten in bestelregels in de database zetten
	$cart = explode("|",$_SESSION['cart']);
	$prijstotaal = $_SESSION['Prijs'];
	$lineprice = $_SESSION['totalprijs'];
	foreach($cart as $products) {
		// Splits het product in stukjes: $product[x] --> x == 0 -> product id, x == 1 -> hoeveelheid
		$product = explode(",",$products);

				  $sql2 = "SELECT `ArtikelNr`, `Naam`, `Prijs` 
				  FROM `ARTIKEL`, `PRIJS`
				  WHERE 
                  `ARTIKEL`.`ArtikelNr` = `PRIJS`.`Art_ArtikelNr` AND
                  `ArtikelNr` = ".$product[0];
                  $result = mysqli_query($conn, $sql2);
                  $pro_cart = mysqli_fetch_object($result);
                  $lineprice = $product[1] * $pro_cart->Prijs;      // regelprijs uitrekenen > hoeveelheid * prijs


		// Hier willen we productprijs toevoegen aan de productregel. De productprijs is de prijs van het 
		// product. Deze zit nog niet in de sessie, en moet daar dus bij het bestellen (bijvoorbeeld 
		// in index.php) in worden gezet.
		// We tellen hier ook het bedrag per product op (prijs x aantal) en tellen dit op bij de totaalprijs.
		// Je kunt in cart.php kijken hoe je dat kunt doen.
		$sql = "INSERT INTO BESTELREGEL (Best_BestellingNr, Art_ArtikelNr, Aantal, Prijs) VALUES
		(".$bestelnr.", ".$product[0].", ".$product[1].", ".$lineprice.")";
		$result = mysqli_query($conn, $sql) or die (mysqli_error($conn)."<br>in file ".__FILE__." on line ".__LINE__);
	}
	// Hieronder volgt de factuur.
	// Eerst wordt connectie gemaakt me de database.

$DBServer = 'localhost';
$DBUser   = 'WebwinkelF4';
$DBPass   = 'groepf4';
$DBName   = 'webwinkel-DB';

error_reporting(E_ERROR | E_PARSE);

$conn = mysqli_connect($DBServer, $DBUser, $DBPass, $DBName);

if (mysqli_connect_errno()) {
	printf("<p><b>Fout: verbinding met de database mislukt (is MySQL actief?).</b><br/>\n%s</p>\n", 
				mysqli_connect_error());
	exit();
}

// De data van de klant wordt geladen door middel van zijn klantnummer. Deze is opgeslagen in een session na de klant ingelogd is.

$sql = "SELECT 
`KLANT`.`Klantnaam`,
`KLANT`.`Mail`,
`KLANT`.`Adres`,
`KLANT`.`Postcode`,
`KLANT`.`Plaats`, 
`KLANT`.`KlantNr` 
FROM 
`KLANT`
WHERE `KLANT`.`KlantNr` = '".$_SESSION['KlantNr']."';";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

// Het klantnummer word omgezet in een variabele. Deze wordt gebruikt om te kijken of de klant is ingelogd.
$check = $_SESSION['KlantNr'];

// Alle waardes worden hier uit het resultaat gehaald en omgezet in een variabele

$to = $row['Mail'];
$Naam = $row['Klantnaam'];
$Adres = $row['Adres'];
$Postcode = $row['Postcode'];
$Plaats = $row['Plaats'];

// De data in de mail wordt opgesteld.
$headers = "Bedankt voor het kiezen voor Buitenlandseproducten.nl";
$subject = "Uw factuur van Buitenlandseproducten.nl";

$message =  
	"Beste $Naam. \r\n" .
    "Uw bestelling wordt momenteel verwerkt en binnen 24 uur verzonden.\r\n" .
    "\r\n" . 
    "Uw bestelling wordt verzonden naar het onderstaande adres:\r\n" . 
    "$Adres\r\n" . 
    "$Postcode\r\n" . 
    "$Plaats\r\n" .

    "\r\n" .

    "De volgende kosten zijn in rekening gebracht: \r\n" . 
    "€ $prijstotaal \r\n" 
    
;

// Er wordt gechecked of de klant is ingelogd en als dit het geval is wordt de mail verzonden.

if(strlen($check) > 0) {
			mail($to, $subject, $message, $headers);
					echo "<h5>" . "Uw bestelling is afgerond. De factuur is naar uw mail gestuurd.\r\n" .
						 "Let op! Er is een kans dat de factuur in uw spam-filter staat.\r\n" . 
						 "Bedankt dat u gekozen heeft voor Buitenlandseproducten.nl en graag tot ziens!" . "</h5>";

						 // De winkelwagen wordt leeggehaald en de sessie wordt gesloten.
						 // De database connectie wordt gesloten.
					if(isset($_SESSION['cart']))
					unset($_SESSION['cart']);
					mysqli_close($conn);


		} else {

			    echo "U bent niet ingelogd!";
		};
}
?>	
</div>

</div>
</div>
</div>
<br>
<div class="panel-footer"></div>
<?php
include ('includes/footer.html');
?>