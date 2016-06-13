

<?php
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
<?php
session_start();
?>

<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover(); 
});
</script>


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

<?php

    $product_id = $_GET['id'];
    $DBServer = '';
    $DBUser   = '';
    $DBPass   = '';
    $DBName   = '-DB';

    $conn = mysql_connect($DBServer, $DBUser, $DBPass);
    mysql_select_db($DBName,$conn);


// Hier worden de producten geselecteerd waarop gezocht is door middel van zoektermen in een get functie.

$qartikelinformatie = mysql_query("SELECT 
`ARTIKEL`.`ArtikelNr`, 
`ARTIKEL`.`Naam`, 
`ARTIKEL`.`Beschrijving`,
`ARTIKEL`.`ProdLand`, 
`ARTIKEL`.`ProdMerk`,
`ARTIKEL`.`SoortProd`,
`ARTIKEL`.`Gewicht`,
`ARTIKEL`.`Grootte`,
`product_afbeelding`.`image_id`,
`PRIJS`.`Prijs`,
`VOORRAAD`.`Aantal`
FROM `ARTIKEL`
JOIN PRIJS ON `ARTIKEL`.`ArtikelNr` = `PRIJS`.`Art_ArtikelNr`
JOIN VOORRAAD ON `ARTIKEL`.`ArtikelNr` = `VOORRAAD`.`Art_ArtikelNr`
JOIN product_afbeelding ON `ARTIKEL`.`ArtikelNr` = `product_afbeelding`.`Art_ArtikelNr`
WHERE `ARTIKEL`.`Naam` LIKE '%".$_GET['id']."%' 
OR `ARTIKEL`.`ProdLand` LIKE '%".$_GET['id']."%'
OR `ARTIKEL`.`ProdMerk` LIKE '%".$_GET['id']."%'
OR `ARTIKEL`.`Beschrijving` LIKE '%".$_GET['id']."%'")or die(mysql_error());



if($qartikelinformatie === false) {
  echo "<p>Er zijn geen overeenkomsten</p>\n";
} else {
  echo "<p>Er zijn overeenkomsten gevonden met dit zoekresultaat</p>\n";
}


while($row = mysql_fetch_array($qartikelinformatie, MYSQLI_ASSOC)){



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

/* maak de resultset leeg */
mysqli_free_result($result);

/* sluit de connection */
mysqli_close($conn);
?>
</div>
</div>
<div class="panel-footer"></div>
<?php
include ('includes/footer.html');
?>