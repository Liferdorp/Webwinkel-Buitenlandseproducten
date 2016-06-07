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

<div class="well" style="margin-top: 40px !important;">
	<h3 class="text-center">Over Buitenlandse Producten.nl</h3>
<p style="font-size:13px;">
      Buitenlandseproducten.nl verkoopt producten uit diverse landen die op authentieke en verantwoorde wijze geproduceerd zijn.
      Aan alle producten die u in de webwinkel vindt, is het <a href="http://www.fairtrade.nl/">Fair Trade Original-keurmerk</a> toegekend.
      Dit keurmerkt verzekert u dat u producten ontvangt die een positieve bijdrage leveren aan de bestrijding van armoede en die ervoor zorgen dat de producenten een betere plek kunnen verwerven in de handelsketen.
      Zo kunnen zij leven van hun werk en kunnen zij investeren in een duurzame toekomst.
      Buitenlandseproducten.nl heeft nauw contact met haar leveranciers en verzekert haarzelf en u ervan dat de voorwaarden van het Fair Trade Original-keurmerk te allen tijde worden nageleefd. Met onze producten kunt u dus op verantwoorde wijze van andere culturen proeven!
      <br><br>Ook kunt u natuurlijk producten kopen, zoals ze vroeger bij u thuis werden gemaakt, volgens de traditionele werkwijze (denk aan nasi met gebakken uitjes en sambal zoals deze door uw ouders werd bereid).
	    Het vooroordeel dat producten met het Fair Trade Original-keurmerk altijd een stuk duurder zijn dan andere producten, gaat bij Buitenlandseproducten.nl niet op.
      Wij importeren immers direct vanaf de producenten, zonder tussenkomst van een dure leverancier. Hiermee verzekeren wij de producenten van een eerlijke prijs en u van een zo laag mogelijke prijs!
  </p>
</div>

  
</div>

<div class="col-sm-5" style="margin-top: 20px !important;">
     <div class="well">
         <div class="row">
             <div class="col-sm-3">
             <span class="glyphicon glyphicon-time" style="color:#05bde1;"></span>
             </div>
                <div class="col-sm-9">
                <h5 style="color:#05bde1;">MORGEN IN HUIS<h5>
                besteld voor 16:00<br>morgen in huis.
               </div>
          </div>
</div>


<div class="well" style="margin-top:32px !important;">         
<div class="row">
    <div class="col-sm-3">
             <span class="glyphicon glyphicon-send" style="color:#05bde1;"></span>
</div>
                <div class="col-sm-9">
<h5 style="color:#05bde1;">GRATIS VERZENDING<h5>
bij bestellingen boven de €50<br>
betaalt u geen verzendkosten.
</div>
</div>
 </div>
<div class="well" style="margin-top: 85px !important;">
<p style="font-size:12px;">
  	<i><b>Wij zijn geïnteresseerd in uw mening!</b> Laat uw reactie achter op onze <a href = "contact.php">contactpagina</a>! Hier kunt u ook terecht voor vragen over Buitenlandseproducten.nl, het Fair Trade Original-keurmerk of één van onze producten.</i>
  	</p>

</div>

</div>

</div>
<hr>
<div class="row">
<div class="col-sm-7">
<h3 class="text-center"><span class="glyphicon glyphicon-pencil" style="color:#05bde1;"></span></h3>
<div class="well" style="background:white !important;">
  <h3 class="text-center">Over de opdracht</h3>
 <p style="font-size:13px;">
    Welkom! Wij zijn Ruben Pals, Jasper Pearson, Jessie den Ridder, Jelle Roks en Chris Schoonens. Wij zijn studenten aan <a href="http://www.avans.nl/">Avans Hogeschool</a> te Breda en we studeren Business IT & Management of Informatica.

    Deze webwinkel maakt deel uit van de groepsopdracht van periode 2. Voor de totstandkoming van deze webwinkel hebben we eerst verschillende analyses uitgevoerd, waaronder een concurrentie- en DESTEP-analyse.
    Tevens hebben we een functioneel en technisch ontwerp geschreven, waarin onder andere de verschillende functionaliteiten en de database van de webwinkel zijn beschreven.
  </p> 
</div>
</div>
<div class="col-sm-5">

<div class="well" style="margin-top:90px;">
<p style="font-size:12px;">
Deze website is intellectueel eigendom van voorgaand genoemde personen. Het kopiëren, aanpassen, of anderzijds gebruiken van deze code is op geen enkele wijze toegestaan zonder expliciete toestemming van de eigenaren.</p>

</div>
 <img src="images/avanslogo.png" alt="Avans" style="margin:30px 0px 5px 100px; width: 50%; "/>
</div>
</div>
	
</div>
<br><br><br>

<div class="panel-footer"></div>
<?php

include ('includes/footer.html');

?>