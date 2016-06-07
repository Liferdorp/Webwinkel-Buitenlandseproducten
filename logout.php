<?php
// logout.php
session_start();

if (empty($_SESSION['KlantNr']))
	echo "<p>U bent uitgelogd.</p>";
else 
	session_unset($_SESSION['KlantNr']);

if (empty($_SESSION['Klantnaam']))
	echo "<p>U ben nu uitgelogd.</p>";
else 
	session_unset($_SESSION['Klantnaam']);

// Direct door naar de homepagina.
header("Location: index.php"); ;

?> 
