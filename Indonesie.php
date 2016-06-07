

<?php
//
// index.php
// Dit is het startscherm van de webwinkel.
//

// Zet het niveau van foutmeldingen zo dat warnings niet getoond worden.
error_reporting(E_ERROR | E_PARSE);

// Zet de titel en laad de HTML header uit het externe bestand.
$page_title = 'Welkom bij Buitenlandseproducten.nl';
$active = 1;  // Zorgt ervoor dat header.html weet dat dit het actieve menu-item is.
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

<?php

// 
// Stap 1: maak verbinding met MySQL.
// Zorg ervoor dat MySQL (via XAMPP) gestart is.
//
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

  //  $sql = "SELECT ArtikelNr, Naam, SoortProd, Gewicht, Grootte, Beschrijving, ProdLand, ProdMerk FROM ARTIKEL";
//    $sql2 = "SELECT `image_id`, `image_type`, `image_size`, `image_name` FROM `afbeelding` ORDER BY `image_id` ASC;" ;
 //   $result = $conn->query($sql,);



// Opdracht: Maak de juiste SQL query die hier de informatie over onze producten gaat opleveren.
 
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
AND `ProdLand` = 'Indonesie';";

//$sql = "SELECT * FROM `ARTIKEL`,`product_afbeelding`,`VOORRAAD`, `PRIJS` WHERE `ArtikelNr` = `Art_ArtikelNr`;";



      
$voorraad = $row["Aantal"];


// Voer de query uit en sla het resultaat op 
$result = mysqli_query($conn, $sql);
  
if($result === false) {
  echo "<p>Er zijn geen producten in de winkel gevonden</p>\n";
} else {
  $num = 0;
  $num = mysqli_num_rows($result);
  echo "<p>Er zijn momenteel " .$num." producten gevonden.</p>\n";
}

// Laat de producten zien in een form, zodat de gebruiker ze kan selecteren.
// Haal een nieuwe regel op uit het resultaat, zolang er nog regels beschikbaar zijn.
// We gebruiken in dit geval een associatief array.
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
}?><!--

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
{
  echo "<div class='titelpagina'>" . "<p>" . "inschrijvingen:" . "</p>" . "</div>" . "<br/>";
         echo "<table class='profile'>"; 
           echo "<tr>"; 
            echo "<th class='ArtikelNr'> ArtikelNr</th>";
            echo "<th class='Naam'> Naam</th>"; 
            echo "<th class='Prijs'> Prijs</th>"; 
            echo "<th class='Beschrijving'> Beschrijving</th>"; 
            echo "<th class='Prodland'> Prodland</th>";
            echo "<th class='Prodmerk'> Prodmerk</th>";
            echo "<th class='image_id'> image_id</th>";
            echo "<th class='Aantal'> Aantal</th>"; 
           echo "</tr>";
             echo "<tr>";
            echo "<th>$ArtikelNr</th>";
            echo "<th>$Naam</th>";
            echo "<th>$Prijs</th>"; 
            echo "<th>$Beschrijving</th>";
            echo "<th>$Prodland</th>"; 
            echo "<th>$Prodmerk</th>"; 
            echo "<th>$image_id</th>"; 
            echo "<th>$Aantal</th>"; 
           echo "</tr>";
 echo "</table>";--><?php

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