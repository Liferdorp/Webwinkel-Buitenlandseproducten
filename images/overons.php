<?php
//
// index.php
// Dit is het startscherm van de webwinkel.
//

// Zet het niveau van foutmeldingen zo dat warnings niet getoond worden.
error_reporting(E_ERROR | E_PARSE);

// Zet de titel en laad de HTML header uit het externe bestand.
$page_title = 'Over ons | buitenlandseproducten.nl';
$active = 4;	// Zorgt ervoor dat header.html weet dat dit het actieve menu-item is.
include ('includes/header.html');
?>
<div class="panel-footer"></div>
<div class = "container text-left">



<div class="row">
<div class="col-sm-7">
	<h3 style="margin-left:20px;">Over Buitenlandseproducten.nl</h3>
<p style="font-size:12px;">
      Buitenlandseproducten.nl verkoopt producten uit diverse landen die op authentieke en verantwoorde wijze geproduceerd zijn.
      Aan alle producten die u in de webwinkel vindt, is het <a href="http://www.fairtrade.nl/">Fair Trade Original-keurmerk</a> toegekend.
      Dit keurmerkt verzekert u dat u producten ontvangt die een positieve bijdrage leveren aan de bestrijding van armoede en die ervoor zorgen dat de producenten een betere plek kunnen verwerven in de handelsketen.
      Zo kunnen zij leven van hun werk en kunnen zij investeren in een duurzame toekomst.
      Buitenlandseproducten.nl heeft nauw contact met haar leveranciers en verzekert haarzelf en u ervan dat de voorwaarden van het Fair Trade Original-keurmerk te allen tijde worden nageleefd. Met onze producten kunt u dus op verantwoorde wijze van andere culturen proeven!
      <br><br>Ook kunt u natuurlijk producten kopen, zoals ze vroeger bij u thuis werden gemaakt, volgens de traditionele werkwijze (denk aan nasi met gebakken uitjes en sambal zoals deze door uw ouders werd bereid).
	    Het vooroordeel dat producten met het Fair Trade Original-keurmerk altijd een stuk duurder zijn dan andere producten, gaat bij Buitenlandseproducten.nl niet op.
      Wij importeren immers direct vanaf de producenten, zonder tussenkomst van een dure leverancier. Hiermee verzekeren wij de producenten van een eerlijke prijs en u van een zo laag mogelijke prijs!
  </p>

  	<p style="font-size:12px;">
  	<i>Wij zijn geïnteresseerd in uw mening! Laat uw reactie achter op onze <a href = "contact.php">contactpagina</a>! Hier kunt u ook terecht voor vragen over Buitenlandseproducten.nl, het Fair Trade Original-keurmerk of één van onze producten.</i>
  	</p>	
  
</div>

<div class="col-sm-5">
<h3 class="text-center">Service</h3>
<hr>
     <div class="well">
         <div class="row">
             <div class="col-sm-3">
             <span class="glyphicon glyphicon-time"></span>
             </div>
                <div class="col-sm-9">
                <h5>MORGEN IN HUIS<h5>
                Bestellingen voor 16:00<br>bezorgd binnen 1 werkdag
               </div>
          </div>
</div>


<div class="well">         
<div class="row">
    <div class="col-sm-3">
             <span class="glyphicon glyphicon-send"></span>
</div>
                <div class="col-sm-9">
<h5>GRATIS VERZENDING<h5>
Alle orders boven €50<br>
worden gratis verzonden
</div>
</div>
 </div>
</div>



</div>
<hr>
<div class="row">
<div class="col-sm-7">
<img src="images/avanslogo.png" />
</div>
<div class="col-sm-5">
  <h3 class="text-center">Over de opdracht</h3>
 <p style="font-size:12px;">
    Welkom! Wij zijn Ruben Pals, Jasper Pearson, Jessie den Ridder, Jelle Roks en Chris Schoonens. Wij zijn studenten aan <a href="http://www.avans.nl/">Avans Hogeschool</a> te Breda en we studeren Business IT & Management of Informatica.

    Deze webwinkel maakt deel uit van de groepsopdracht van periode 2. Voor de totstandkoming van deze webwinkel hebben we eerst verschillende analyses uitgevoerd, waaronder een concurrentie- en DESTEP-analyse.
    Tevens hebben we een functioneel en technisch ontwerp geschreven, waarin onder andere de verschillende functionaliteiten en de database van de webwinkel zijn beschreven.
  </p>  
</div>
</div>
	
</div>


<div class="panel-footer"></div>
<?php

include ('includes/footer.html');

?>