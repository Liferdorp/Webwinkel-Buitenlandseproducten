

<?php

session_start();

//
// index.php
// Dit is het startscherm van de webwinkel.
//

// Zet het niveau van foutmeldingen zo dat warnings niet getoond worden.
error_reporting(E_ERROR | E_PARSE);

// Zet de titel en laad de HTML header uit het externe bestand.
$page_title = 'Welkom bij Buitenlandseproducten.nl';
$active = 1;	// Zorgt ervoor dat header.html weet dat dit het actieve menu-item is.
include ('includes/header.html');

?>
<script>
    $('.carousel').carousel({
        interval: 400
    })
</script>
	<div class="slideshow hidden-xs">

<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0"></li>
    <li data-target="#myCarousel" data-slide-to="1" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item">
      <img src="images/bolognese.jpg" alt="Spaghetti Bolognese">
      <div class="carousel-caption">
        <h3>Pasta</h3>
        <p><h4>Hier vindt u alleen de beste pasta's, op authentieke wijze gemaakt in Italie.<br>Creatief? Maak met onze pastamachines uw pasta helemaal bijzonder!</h4></p>
      </div>
    </div>

    <div class="item active">
      <img src="images/rice.jpg" alt="Rijst">
      <div class="carousel-caption">
        <h3>Rijst</h3>
        <p><h4>Onze vele soorten rijst worden verbouwd op de beste plantages die Azië biedt.<br>Dit zodat u zeker bent van alleen het beste product!</h4></p>
      </div>
    </div>


    <div class="item">
      <img src="images/choco.jpg" alt="Chocolade">
      <div class="carousel-caption">
        <h3>Chocolade</h3>
        <p><h4>Van Cadbury tot Belgische bonbons,<br>U bent aan het juiste adres voor alleen de beste chocolade!</h4></p>
      </div>
    </div>

  
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>

<div class="panel-footer">
</div>
<div class="container">
<a name="shop"></a>
<hr>

<?php
include ('includes/navigatie.html');
?>


<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#1-16">1-16</a></li>
  <li><a data-toggle="tab" href="#17-32">17-32</a></li>
  <li><a data-toggle="tab" href="#33-48">33-48</a></li>
  <li><a data-toggle="tab" href="#49-64">49-64</a></li>
  <li><a data-toggle="tab" href="#65-80">65-80</a></li>
  <li><a data-toggle="tab" href="#81-96">81-96</a></li>
  <li><a data-toggle="tab" href="#97-109">97-109</a></li>
</ul>

<div class="tab-content">
        <div id="1-16" class="tab-pane fade in active">

<?php


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


 
$sql = "SELECT 
`ARTIKEL`.`ArtikelNr`, 
`ARTIKEL`.`Naam`, 
`PRIJS`.`Prijs`, 
`ARTIKEL`.`Beschrijving`,
`ARTIKEL`.`Prodland`, 
`ARTIKEL`.`Prodmerk`, 
`product_afbeelding`.`image_id`,
`VOORRAAD`.`Aantal`
FROM `ARTIKEL`, `product_afbeelding`, `VOORRAAD`, `PRIJS`
WHERE `ARTIKEL`.`ArtikelNr` = `product_afbeelding`.`Art_ArtikelNr`
AND `ARTIKEL`.`ArtikelNr` = `VOORRAAD`.`Art_ArtikelNr`
AND `ARTIKEL`.`ArtikelNr` = `PRIJS`.`Art_ArtikelNr`
AND `PRIJS`.`Prijs` > 0
LIMIT 0 , 16;";

    



$result = mysqli_query($conn, $sql);





while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
{
	echo "<!-- ---------------------------------- -->\n";
	echo "<div id=\"product\">\n<form action=\"add.php\" method=\"post\">\n";
	echo "<input type=\"hidden\" name=\"ArtikelNr\" value=\"".$row["ArtikelNr"]."\" />\n";
	echo "<input type=\"hidden\" name=\"prijs\" value=\"".$row["Prijs"]."\" />\n";
	echo "<div id=\"prodnaam\"><strong>".$row["Naam"]."</strong></div>\n";
       echo "<hr>\n";
	echo '<p>'. '<a href="product.php?id='.$row['ArtikelNr'].'" title="Product informatie" data-toggle="popover" data-trigger="hover" data-content="Klik hier om naar het product te gaan" >' . '<img class=\'image-frame-index\' src="showfile.php?image_id='.$row["image_id"].'">' . ' </a>'. '</p>';
	echo "<div id=\"prijs\">€ ".number_format($row["Prijs"], 2, ',', '.')."</div>\n";
       echo "<hr>\n";
	echo "<div class=\"selecteer\">Aantal: <input type=\"number\" name=\"hoeveelheid\" size=\"2\" maxlength=\"2\" value=\"1\" min=\"1\" max=\"".$row["Aantal"]."\"/>";
	echo "<input type=\"submit\" value=\"BESTEL\" class=\"button\"/></div>\n";
	echo "<div id=\"voorraad\">Voorraad: ".$row["Aantal"]."</div>\n";
	echo "</form>\n</div>\n";
}
  $laatestenummer = $row["index"];
mysqli_free_result($result);

mysqli_close($conn);
?>
</div>

        <div id="17-32" class="tab-pane fade">
<?php


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


 
$sql = "SELECT 
`ARTIKEL`.`ArtikelNr`, 
`ARTIKEL`.`Naam`, 
`PRIJS`.`Prijs`, 
`ARTIKEL`.`Beschrijving`,
`ARTIKEL`.`Prodland`, 
`ARTIKEL`.`Prodmerk`, 
`product_afbeelding`.`image_id`,
`VOORRAAD`.`Aantal`
FROM `ARTIKEL`, `product_afbeelding`, `VOORRAAD`, `PRIJS`
WHERE `ARTIKEL`.`ArtikelNr` = `product_afbeelding`.`Art_ArtikelNr`
AND `ARTIKEL`.`ArtikelNr` = `VOORRAAD`.`Art_ArtikelNr`
AND `ARTIKEL`.`ArtikelNr` = `PRIJS`.`Art_ArtikelNr`
AND `PRIJS`.`Prijs` > 0
LIMIT 16 , 16;";







$result = mysqli_query($conn, $sql);
  



while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
{
  echo "<!-- ---------------------------------- -->\n";
  echo "<div id=\"product\">\n<form action=\"add.php\" method=\"post\">\n";
  echo "<input type=\"hidden\" name=\"ArtikelNr\" value=\"".$row["ArtikelNr"]."\" />\n";
  echo "<input type=\"hidden\" name=\"prijs\" value=\"".$row["Prijs"]."\" />\n";
  echo "<div id=\"prodnaam\">".$row["Naam"]."</div>\n";
       echo "<hr>\n";
  echo '<p>'. '<a href="product.php?id='.$row['ArtikelNr'].'" title="Product informatie" data-toggle="popover" data-trigger="hover" data-content="Klik hier om naar het product te gaan" >' . '<img class=\'image-frame-index\' src="showfile.php?image_id='.$row["image_id"].'">' . ' </a>'. '</p>';
  echo "<div id=\"prijs\">€ ".number_format($row["Prijs"], 2, ',', '.')."</div>\n";
       echo "<hr>\n";
  echo "<div class=\"selecteer\">Aantal: <input type=\"number\" name=\"hoeveelheid\" size=\"2\" maxlength=\"2\" value=\"1\" min=\"1\" max=\"".$row["Aantal"]."\"/>";
  echo "<input type=\"submit\" value=\"BESTEL\" class=\"button\"/></div>\n";
  echo "<div id=\"voorraad\">Voorraad: ".$row["Aantal"]."</div>\n";
  echo "</form>\n</div>\n";
}
  $laatestenummer = $row["index"];
mysqli_free_result($result);

mysqli_close($conn);
?>
</div>

<div id="33-48" class="tab-pane fade">
<?php


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


 
$sql = "SELECT 
`ARTIKEL`.`ArtikelNr`, 
`ARTIKEL`.`Naam`, 
`PRIJS`.`Prijs`, 
`ARTIKEL`.`Beschrijving`,
`ARTIKEL`.`ProdLand`, 
`ARTIKEL`.`ProdMerk`, 
`product_afbeelding`.`image_id`,
`VOORRAAD`.`Aantal`
FROM `ARTIKEL`, `product_afbeelding`, `VOORRAAD`, `PRIJS`
WHERE `ARTIKEL`.`ArtikelNr` = `product_afbeelding`.`Art_ArtikelNr`
AND `ARTIKEL`.`ArtikelNr` = `VOORRAAD`.`Art_ArtikelNr`
AND `ARTIKEL`.`ArtikelNr` = `PRIJS`.`Art_ArtikelNr`
AND `PRIJS`.`Prijs` > 0
LIMIT 32 , 16;";




$result = mysqli_query($conn, $sql);
  



while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
{
  echo "<!-- ---------------------------------- -->\n";
  echo "<div id=\"product\">\n<form action=\"add.php\" method=\"post\">\n";
  echo "<input type=\"hidden\" name=\"ArtikelNr\" value=\"".$row["ArtikelNr"]."\" />\n";
  echo "<input type=\"hidden\" name=\"prijs\" value=\"".$row["Prijs"]."\" />\n";
  echo "<div id=\"prodnaam\">".$row["Naam"]."</div>\n";
       echo "<hr>\n";
  echo '<p>'. '<a href="product.php?id='.$row['ArtikelNr'].'" title="Product informatie" data-toggle="popover" data-trigger="hover" data-content="Klik hier om naar het product te gaan" >' . '<img class=\'image-frame-index\' src="showfile.php?image_id='.$row["image_id"].'">' . ' </a>'. '</p>';
  echo "<div id=\"prijs\">€ ".number_format($row["Prijs"], 2, ',', '.')."</div>\n";
       echo "<hr>\n";
  echo "<div class=\"selecteer\">Aantal: <input type=\"number\" name=\"hoeveelheid\" size=\"2\" maxlength=\"2\" value=\"1\" min=\"1\" max=\"".$row["Aantal"]."\"/>";
  echo "<input type=\"submit\" value=\"BESTEL\" class=\"button\"/></div>\n";
  echo "<div id=\"voorraad\">Voorraad: ".$row["Aantal"]."</div>\n";
  echo "</form>\n</div>\n";
  $laatestenummer = $row["index"];


  
}
mysqli_free_result($result);

mysqli_close($conn);
?>
</div>

        <div id="49-64" class="tab-pane fade">
<?php


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


 
$sql = "SELECT 
`ARTIKEL`.`ArtikelNr`, 
`ARTIKEL`.`Naam`, 
`PRIJS`.`Prijs`, 
`ARTIKEL`.`Beschrijving`,
`ARTIKEL`.`Prodland`, 
`ARTIKEL`.`Prodmerk`, 
`product_afbeelding`.`image_id`,
`VOORRAAD`.`Aantal`
FROM `ARTIKEL`, `product_afbeelding`, `VOORRAAD`, `PRIJS`
WHERE `ARTIKEL`.`ArtikelNr` = `product_afbeelding`.`Art_ArtikelNr`
AND `ARTIKEL`.`ArtikelNr` = `VOORRAAD`.`Art_ArtikelNr`
AND `ARTIKEL`.`ArtikelNr` = `PRIJS`.`Art_ArtikelNr`
AND `PRIJS`.`Prijs` > 0
LIMIT 48 , 16;";







$result = mysqli_query($conn, $sql);
  



while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
{
  echo "<!-- ---------------------------------- -->\n";
  echo "<div id=\"product\">\n<form action=\"add.php\" method=\"post\">\n";
  echo "<input type=\"hidden\" name=\"ArtikelNr\" value=\"".$row["ArtikelNr"]."\" />\n";
  echo "<input type=\"hidden\" name=\"prijs\" value=\"".$row["Prijs"]."\" />\n";
  echo "<div id=\"prodnaam\">".$row["Naam"]."</div>\n";
       echo "<hr>\n";
  echo '<p>'. '<a href="product.php?id='.$row['ArtikelNr'].'" title="Product informatie" data-toggle="popover" data-trigger="hover" data-content="Klik hier om naar het product te gaan" >' . '<img class=\'image-frame-index\' src="showfile.php?image_id='.$row["image_id"].'">' . ' </a>'. '</p>';
  echo "<div id=\"prijs\">€ ".number_format($row["Prijs"], 2, ',', '.')."</div>\n";
       echo "<hr>\n";
  echo "<div class=\"selecteer\">Aantal: <input type=\"number\" name=\"hoeveelheid\" size=\"2\" maxlength=\"2\" value=\"1\" min=\"1\" max=\"".$row["Aantal"]."\"/>";
  echo "<input type=\"submit\" value=\"BESTEL\" class=\"button\"/></div>\n";
  echo "<div id=\"voorraad\">Voorraad: ".$row["Aantal"]."</div>\n";
  echo "</form>\n</div>\n";

  $laatestenummer = $row["index"];
}
mysqli_free_result($result);

mysqli_close($conn);
?>
</div>

        <div id="65-80" class="tab-pane fade">
<?php


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


 
$sql = "SELECT 
`ARTIKEL`.`ArtikelNr`, 
`ARTIKEL`.`Naam`, 
`PRIJS`.`Prijs`, 
`ARTIKEL`.`Beschrijving`,
`ARTIKEL`.`Prodland`, 
`ARTIKEL`.`Prodmerk`, 
`product_afbeelding`.`image_id`,
`VOORRAAD`.`Aantal`
FROM `ARTIKEL`, `product_afbeelding`, `VOORRAAD`, `PRIJS`
WHERE `ARTIKEL`.`ArtikelNr` = `product_afbeelding`.`Art_ArtikelNr`
AND `ARTIKEL`.`ArtikelNr` = `VOORRAAD`.`Art_ArtikelNr`
AND `ARTIKEL`.`ArtikelNr` = `PRIJS`.`Art_ArtikelNr`
AND `PRIJS`.`Prijs` > 0
LIMIT 64 , 16;";







$result = mysqli_query($conn, $sql);
  



while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
{
  echo "<!-- ---------------------------------- -->\n";
  echo "<div id=\"product\">\n<form action=\"add.php\" method=\"post\">\n";
  echo "<input type=\"hidden\" name=\"ArtikelNr\" value=\"".$row["ArtikelNr"]."\" />\n";
  echo "<input type=\"hidden\" name=\"prijs\" value=\"".$row["Prijs"]."\" />\n";
  echo "<div id=\"prodnaam\">".$row["Naam"]."</div>\n";
       echo "<hr>\n";
  echo '<p>'. '<a href="product.php?id='.$row['ArtikelNr'].'" title="Product informatie" data-toggle="popover" data-trigger="hover" data-content="Klik hier om naar het product te gaan" >' . '<img class=\'image-frame-index\' src="showfile.php?image_id='.$row["image_id"].'">' . ' </a>'. '</p>';
  echo "<div id=\"prijs\">€ ".number_format($row["Prijs"], 2, ',', '.')."</div>\n";
       echo "<hr>\n";
  echo "<div class=\"selecteer\">Aantal: <input type=\"number\" name=\"hoeveelheid\" size=\"2\" maxlength=\"2\" value=\"1\" min=\"1\" max=\"".$row["Aantal"]."\"/>";
  echo "<input type=\"submit\" value=\"BESTEL\" class=\"button\"/></div>\n";
  echo "<div id=\"voorraad\">Voorraad: ".$row["Aantal"]."</div>\n";
  echo "</form>\n</div>\n";

  $laatestenummer = $row["index"];
}
mysqli_free_result($result);

mysqli_close($conn);
?>
</div>

        <div id="81-96" class="tab-pane fade">
<?php


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


 
$sql = "SELECT 
`ARTIKEL`.`ArtikelNr`, 
`ARTIKEL`.`Naam`, 
`PRIJS`.`Prijs`, 
`ARTIKEL`.`Beschrijving`,
`ARTIKEL`.`Prodland`, 
`ARTIKEL`.`Prodmerk`, 
`product_afbeelding`.`image_id`,
`VOORRAAD`.`Aantal`
FROM `ARTIKEL`, `product_afbeelding`, `VOORRAAD`, `PRIJS`
WHERE `ARTIKEL`.`ArtikelNr` = `product_afbeelding`.`Art_ArtikelNr`
AND `ARTIKEL`.`ArtikelNr` = `VOORRAAD`.`Art_ArtikelNr`
AND `ARTIKEL`.`ArtikelNr` = `PRIJS`.`Art_ArtikelNr`
AND `PRIJS`.`Prijs` > 0
LIMIT 80 , 16;";







$result = mysqli_query($conn, $sql);
  



while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
{
  echo "<!-- ---------------------------------- -->\n";
  echo "<div id=\"product\">\n<form action=\"add.php\" method=\"post\">\n";
  echo "<input type=\"hidden\" name=\"ArtikelNr\" value=\"".$row["ArtikelNr"]."\" />\n";
  echo "<input type=\"hidden\" name=\"prijs\" value=\"".$row["Prijs"]."\" />\n";
  echo "<div id=\"prodnaam\">".$row["Naam"]."</div>\n";
       echo "<hr>\n";
  echo '<p>'. '<a href="product.php?id='.$row['ArtikelNr'].'" title="Product informatie" data-toggle="popover" data-trigger="hover" data-content="Klik hier om naar het product te gaan" >' . '<img class=\'image-frame-index\' src="showfile.php?image_id='.$row["image_id"].'">' . ' </a>'. '</p>';
  echo "<div id=\"prijs\">€ ".number_format($row["Prijs"], 2, ',', '.')."</div>\n";
       echo "<hr>\n";
  echo "<div class=\"selecteer\">Aantal: <input type=\"number\" name=\"hoeveelheid\" size=\"2\" maxlength=\"2\" value=\"1\" min=\"1\" max=\"".$row["Aantal"]."\"/>";
  echo "<input type=\"submit\" value=\"BESTEL\" class=\"button\"/></div>\n";
  echo "<div id=\"voorraad\">Voorraad: ".$row["Aantal"]."</div>\n";
  echo "</form>\n</div>\n";

  $laatestenummer = $row["index"];
}
mysqli_free_result($result);

mysqli_close($conn);
?>
</div>

        <div id="97-109" class="tab-pane fade">
<?php


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


 
$sql = "SELECT 
`ARTIKEL`.`ArtikelNr`, 
`ARTIKEL`.`Naam`, 
`PRIJS`.`Prijs`, 
`ARTIKEL`.`Beschrijving`,
`ARTIKEL`.`Prodland`, 
`ARTIKEL`.`Prodmerk`, 
`product_afbeelding`.`image_id`,
`VOORRAAD`.`Aantal`
FROM `ARTIKEL`, `product_afbeelding`, `VOORRAAD`, `PRIJS`
WHERE `ARTIKEL`.`ArtikelNr` = `product_afbeelding`.`Art_ArtikelNr`
AND `ARTIKEL`.`ArtikelNr` = `VOORRAAD`.`Art_ArtikelNr`
AND `ARTIKEL`.`ArtikelNr` = `PRIJS`.`Art_ArtikelNr`
AND `PRIJS`.`Prijs` > 0
LIMIT 96 , 13;";







$result = mysqli_query($conn, $sql);
  



while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
{
  echo "<!-- ---------------------------------- -->\n";
  echo "<div id=\"product\">\n<form action=\"add.php\" method=\"post\">\n";
  echo "<input type=\"hidden\" name=\"ArtikelNr\" value=\"".$row["ArtikelNr"]."\" />\n";
  echo "<input type=\"hidden\" name=\"prijs\" value=\"".$row["Prijs"]."\" />\n";
  echo "<div id=\"prodnaam\">".$row["Naam"]."</div>\n";
       echo "<hr>\n";
  echo '<p>'. '<a href="product.php?id='.$row['ArtikelNr'].'" title="Product informatie" data-toggle="popover" data-trigger="hover" data-content="Klik hier om naar het product te gaan" >' . '<img class=\'image-frame-index\' src="showfile.php?image_id='.$row["image_id"].'">' . ' </a>'. '</p>';
  echo "<div id=\"prijs\">€ ".number_format($row["Prijs"], 2, ',', '.')."</div>\n";
       echo "<hr>\n";
  echo "<div class=\"selecteer\">Aantal: <input type=\"number\" name=\"hoeveelheid\" size=\"2\" maxlength=\"2\" value=\"1\" min=\"1\" max=\"".$row["Aantal"]."\"/>";
  echo "<input type=\"submit\" value=\"BESTEL\" class=\"button\"/></div>\n";
  echo "<div id=\"voorraad\">Voorraad: ".$row["Aantal"]."</div>\n";
  echo "</form>\n</div>\n";
}
mysqli_free_result($result);

mysqli_close($conn);
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