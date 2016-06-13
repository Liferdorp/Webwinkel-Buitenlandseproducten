<?php
//
// index.php
// Dit is het startscherm van de webwinkel.
//

// Zet het niveau van foutmeldingen zo dat warnings niet getoond worden.
error_reporting(E_ALL);

// Zet de titel en laad de HTML header uit het externe bestand.
$page_title = 'Welkom bij Buitenlandseproducten.nl';
$active = 1;	// Zorgt ervoor dat header.html weet dat dit het actieve menu-item is.
include ('includes/header.html');

?>

<?php
session_start();
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

<?php include ('includes/navigatie.html'); ?>
<?php
		$product_id = $_GET['id'];
		$DBServer = '';
		$DBUser   = '';
		$DBPass   = '';
		$DBName   = '-DB';

		$conn = mysql_connect($DBServer, $DBUser, $DBPass);
		mysql_select_db($DBName,$conn);

// Hier wordt het product geladen dat geselcteerd is. Dit woord doormiddel van een get gedaan.

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
WHERE `ARTIKEL`.`ArtikelNr` = ".$_GET['id'])or die(mysql_error());

$fartikelinfo = mysql_fetch_array($qartikelinformatie);

$row["image_id"] = $fartikelinfo['image_id'];
$row["Aantal"] = $fartikelinfo['Aantal'];
$row["Prijs"] = $fartikelinfo['Prijs'];
$row["ArtikelNr"] = $fartikelinfo['ArtikelNr'];
$row["ProdLand"] = $fartikelinfo['ProdLand'];
$row["ProdMerk"] = $fartikelinfo['ProdMerk'];
        ?>



<div class="container-fluid">
    <div class="content-wrapper">	
		<div class="item-container">	
			<div class="container">	
                               <div class="row">
					<div class="product col-md-4 service-image-left">
						<center>

							<?php 
							echo '<p><img class=\'foto-product-pagina\' src="showfile.php?image_id='.$row["image_id"].'"></p>';
							?>
                                                <div class="btn-group cart">
						<?php 
						echo "<!-- ---------------------------------- -->\n";
						echo "<div id=\"product-pagina\">\n<form action=\"add.php\" method=\"post\">\n";
						echo "<input type=\"hidden\" name=\"ArtikelNr\" value=\"".$row["ArtikelNr"]."\" />\n";
						echo "<input type=\"hidden\" name=\"prijs\" value=\"".$row["Prijs"]."\" />\n";
						echo "<div class=\"selecteer\">Aantal: <input type=\"number\" name=\"hoeveelheid\" size=\"2\" maxlength=\"2\" value=\"1\" min=\"1\" max=\"".$row["Aantal"]."\"/>";
						echo "<input type=\"submit\" value=\"Bestel\" class=\"button\"/></div>\n";
						echo "<div id=\"voorraad\">Voorraad: ".$row["Aantal"]."</div>\n";
						echo "</form>\n</div>\n";
						
						?>
					</div>
						</center>
					</div>	

					
				<div class="col-md-8">
					
<br>
		<div class="container-fluid textalignleft">		
			<div class="product-info">
					<ul id="myTab" class="nav nav-tabs nav_tabs">
						
						<li class="active"><a href="#service-one" data-toggle="tab">ALGEMENE INFORMATIE</a></li>
						<li><a href="#service-two" data-toggle="tab">PRODUCT SPECIFICATIES</a></li>
						<li><a href="#service-three" data-toggle="tab">REVIEWS</a></li>
						
					</ul>
				<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade in active" id="service-one">
						 
							<section class="product-info">
							
								<h2><?php 
									echo '<p>' . $fartikelinfo['Naam'] . '</p>';
									echo '<p>' . "€" . $fartikelinfo['Prijs'] . '</p>' ;
								?></h2>

							</section>
										  
						</div>
					<div class="tab-pane fade" id="service-two" textalignleft>
						
								<h3>Uitgebreide informatie</h3>
 
<table class="table table-bordered table-condensed">

<tr>
<th>Gewicht / Inhoud</th>
<td><?php echo $fartikelinfo['Gewicht']; ?></td>
</tr>

<tr>
<th>Soort product</th>
<td><?php echo $fartikelinfo['SoortProd']; ?></td>
</tr>

<tr>
<th>Land van productie</th>
<td><?php echo $fartikelinfo['ProdLand']; ?></td>
</tr>

<tr>
<th>Merk</th>
<td><?php echo $fartikelinfo['ProdMerk'] ; ?></td>
</tr>

<tr>
<th>Uitgebreide beschrijving</th>
<td><?php echo $fartikelinfo['Beschrijving']; ?></td>
</tr>

</table>

						</section>
						
					</div>
					<div class="tab-pane fade" id="service-three">
							 
<script>
hcb_user = {

    comments_header : ' ',
    name_label : 'Naam',
    content_label: 'Laat hier uw reactie achter',
    submit : 'Plaats',
    logout_link : '<img title="log out" src="//www.htmlcommentbox.com/static/images/door_out.png" alt="[logout]" class="hcb-icon"/>',
    admin_link : '<img src="//www.htmlcommentbox.com/static/images/door_in.png" alt="[login]" class="hcb-icon"/>',
    no_comments_msg: 'Nog geen berichten geplaatst.',
    add:'voeg bericht toe',
    again: 'Plaats nog een bericht',
    rss:' ',
    said:'zei:',
    prev_page:'<img src="//www.htmlcommentbox.com/static/images/arrow_left.png" class="hcb-icon" title="previous page" alt="[prev]"/>',
    next_page:'<img src="//www.htmlcommentbox.com/static/images/arrow_right.png" class="hcb-icon" title="next page" alt="[next]"/>',
    showing:'Showing',
    to:'to',
    website_label:'website (optional)',
    email_label:'email',
    anonymous:'Anonymous',
    mod_label:'(mod)',
    subscribe:'email me replies',
    are_you_sure:'Is dit bericht ongewenst?',
    flag:' ',
    like:'<img src="//www.htmlcommentbox.com/static/images/like.png"/> like',
    
    days_ago:'dagen geleden',
    hours_ago:'uur geleden',
    minutes_ago:'minuten geleden',
    within_the_last_minute:'minder dan een minuut geleden',

    msg_thankyou:'dank u voor het plaatsen van een bericht!',
    msg_approval:'(this comment is not published until approved)',
    msg_approval_required:'Dank u voor het plaatsen van een bericht, dit wordt eerst gecontroleerd door een admin',
    
    err_bad_html:'Je review bevat verkeerde HTML-code',
    err_bad_email:'voer een geldig e-mailadres in',
    err_too_frequent:'Wacht een paar seconden alvorens weer te reageren',
    err_comment_empty:'Je bericht is leeg!',
    err_denied:'Je review is niet geaccepteerd.',

    MAX_CHARS: 8192,
    PAGE:'', // ID of the webpage to show comments for. defaults to the webpage the user is currently visiting.
    RELATIVE_DATES:true 
};


</script>

<!-- begin htmlcommentbox.com -->
 <div id="HCB_comment_box"></div>
 <link rel="stylesheet" type="text/css" href="http://www.htmlcommentbox.com/static/skins/default/skin.css" />
 <script type="text/javascript" language="javascript" id="hcb"> /*<!--*/ if(!window.hcb_user){hcb_user={  };} (function(){s=document.createElement("script");s.setAttribute("type","text/javascript");s.setAttribute("src", "http://www.htmlcommentbox.com/jread?page="+escape((window.hcb_user && hcb_user.PAGE)||(""+window.location)).replace("+","%2B")+"&opts=470&num=10");if (typeof s!="undefined") document.getElementsByTagName("head")[0].appendChild(s);})(); /*-->*/ </script>
<!-- end htmlcommentbox.com -->




			
					</div>
				</div>
				<hr>
			</div>
		</div>
	</div>
       </div>

		</div>
         </div>


				</div>
	</div> 
	
<hr>

<?php





$land = $fartikelinfo['ProdLand'];
$artikelnr = $fartikelinfo['ArtikelNr'];


    $DBServer = '';
    $DBUser   = '';
    $DBPass   = '';
    $DBName   = '-DB';

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
AND `ARTIKEL`.`ProdLand` = '$land'
AND `ARTIKEL`.`ArtikelNr` <> '$artikelnr'
LIMIT 0 , 4;";




      
$voorraad = $row["Aantal"];


$result = mysqli_query($conn, $sql);
  
if($result === false) {
  echo "<h5>Er zijn geen vergelijkbare producten in de winkel gevonden</h5>\n";
} else {
  $num = 0;
  $num = mysqli_num_rows($result);
  echo "<h5>Gerelateerde artikelen:</h5>\n";
}



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



<div class="panel-footer"></div>
<?php
include ('includes/footer.html');
?>