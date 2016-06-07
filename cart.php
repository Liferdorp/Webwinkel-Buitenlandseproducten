
<?php


$page_title = 'Winkelwagen';
include ('includes/header.html');

// mysqli_connect.php bevat de inloggegevens voor de database.
// Per server is er een apart inlogbestand - localhost vs. remote server
include ('includes/mysqli_connect_'.$_SERVER['SERVER_NAME'].'.php');
?>
<div class="panel-footer"></div>
<style>
body {

}
</style>
<?php
// Page header:
echo '<h2>Winkelwagen <span class="glyphicon glyphicon-shopping-cart" style="font-size: 20px;"></span></h2>';
echo '<hr>';
// cart.php
// winkelwagen met bijbehorende functionaliteit
session_start();

// Kijk of er iets in de winkelwagen zit
if (empty($_SESSION['cart'])) {
    echo "<p><h5>Winkelwagen is leeg<br><a href='index.php'><button class='btn button1 btn-primary' type='button'><span>Naar de winkel</span></button></a><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br></h5></p>\n";
}
else {
    // Exploden
    $cart = explode("|",$_SESSION['cart']);

    // Tellen inhoud winkelwagen
    $count = count($cart);
    if ($count == 1) {
        echo "<h5>Er staat 1 product in je winkelwagen.</h5>\n";
echo" <a href='javascript:removeCart()' style='font-size: 15px;margin-top:-30px;'>Winkelwagen leegmaken</a><br/><br><br>";
    } 


else {
        echo "<p><h5>Er staan ".$count." producten in je winkelwagen</h5></p>\n";
    }

    // Wat javascriptjes voor het weghalen van producten
    // En daarna het begin van een tabel met de inhoud
    ?>
    <script type="text/javascript">
    <!--
    function removeItem(item) {
        var answer = confirm ('Weet je zeker dat je dit product wilt verwijderen?')
        if (answer)
            window.location="delete_cart_item.php?item=" + item;
    }

    function removeCart() {
        var answer = confirm ('Weet je zeker dat je de winkelwagen wilt leeghalen?')
        if (answer)
            window.location="delete_cart.php";
    }
    //-->
    </script>



<a href="index.php"><button class="btn button1 btn-primary" type="button"><span>Verder winkelen</span></button></a>
<br>

    <!-- print de table head. Onder de table head komt de informatie met behulp van ph. -->
    <form method="post" name="form" action="update_cart.php">
    <table class="table table-hover">
	<thead>
    <tr>
        <th style="text-align:center;">Productnr</th>
        <th style="text-align:center;">Productnaam</th>
        <th style="text-align:center;">Hoeveelheid</th>
        <th style="text-align:center;">Prijs p/s</th>
        <th style="text-align:center;">Totaal</th>
        <th style="text-align:center;">&nbsp;</th> 
    </tr>
	</thead>
    <?php

    // Totaal (komt later terug)
    $total = 0;
	
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

    // Toon de producten in de winkelwagen
    $i = 0;
    foreach($cart as $products) {
      // Splits het product in stukjes: $product[x] --> x == 0 -> product id, x == 1 -> hoeveelheid
      $product = explode(",", $products);

      if (strlen(trim($product[1])) <> 0) {
		  // Get product info
		  $sql = "SELECT `ArtikelNr`, `Naam`, `Prijs` 
				  FROM `ARTIKEL`, `PRIJS`
				  WHERE 
                  `ARTIKEL`.`ArtikelNr` = `PRIJS`.`Art_ArtikelNr` AND
                  `ArtikelNr` = ".$product[0];  // Weet je nog, uit die sessie
				  
		  $result = mysqli_query($conn, $sql) or die (mysqli_error($conn)."<br>in file ".__FILE__." on line ".__LINE__);
		  $pro_cart = mysqli_fetch_object($result);
		  $i++;
		  echo "<tbody>\n<tr>\n";
		  echo "  <td>".$pro_cart->ArtikelNr."</td>\n";   // nummer
		  echo "  <td>".$pro_cart->Naam."</td>\n";     // naam
		  echo "  <td><input type=\"hidden\" name=\"productnummer_".$i."\" value=\"".$product[0]."\" />\n"; // wat onzichtbare vars voor het updaten
		  echo "  <input type=\"text\" name=\"hoeveelheid_".$i."\" value=\"".$product[1]."\" size=\"2\" maxlength=\"2\" /></td>\n";
		  echo "  <td>€ ".number_format($pro_cart->Prijs, 2, ',', '.')."</td>\n";
		  $lineprice = $product[1] * $pro_cart->Prijs;      // regelprijs uitrekenen > hoeveelheid * prijs
		  echo "  <td>€ ".number_format($lineprice, 2, ',', '')."</td>\n";
		  echo "  <td><a href=\"javascript:removeItem(".$i.")\"><img src=\"images\delete.png\"/></a></td>\n"; // Verwijder, mooi plaatje van prullebak ofzo
		  echo "</tr>\n</tbody>";
		  // Total
		  $total = $total + $lineprice;         // Totaal updaten
          $_SESSION['Prijs'] = $total;          // Slaat de totaal prijs op. Deze wordt gebruikt in de factuur.
          

      }
    }
    ?>
	<tfoot>
    <tr>
        <td colspan="4"><strong>Totaal</strong></td>
        <td><strong><?php echo "€ ".number_format($total, 2, ',', '.'); ?></strong></td>
        <td>&nbsp;</td>
    </tr>
	</tfoot>
    <tr>
        <td colspan="2">&nbsp;</td>
        <td colspan="4"><input type="submit" value="Alles verwijderen" /></td>
    </tr>
    </table>
    </form>
  <p>

<a href="checkout.php"><button class="btn button1 btn-primary" type="button"><span>Afrekenen</span></button></a>

	
  </p>

<div class="panel-footer"></div>
  <?php
}
	
include ('includes/footer.html');

?> 
