<?php
//
// index.php
// Dit is het startscherm van de webwinkel.
//

// Zet het niveau van foutmeldingen zo dat warnings niet getoond worden.
error_reporting(E_ERROR | E_PARSE);

// Zet de titel en laad de HTML header uit het externe bestand.
$page_title = 'Over ons | buitenlandseproducten.nl';
$active = 3;	// Zorgt ervoor dat header.html weet dat dit het actieve menu-item is.
include ('includes/header.html');

?>
<div class="panel-footer"></div>

          <div class="container text-center">
    <div class="row">
        <div class="col-md-12">
            <div class="well" style="margin-top:30px;background:transparent;">
                <form class="form-horizontal" action="<?php $_PHP_SELF; ?>" method = "POST">
                    <fieldset>
                        <legend class="text-center header">Vul onderstaand formulier in om contact met ons op te nemen.</legend>

                        <div class="form-group">
                           <span class="col-md-1 col-md-offset-1 text-center" style="margin-top:10px;"><i class="fa fa-user"></i></span>
                            <div class="col-md-8">
                                <input id="fname" name="name" type="text" placeholder="Naam" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-1 text-center" style="margin-top:10px;"><i class="fa fa-envelope"></i></span>
                            <div class="col-md-8">
                                <input id="email" name="email" type="text" placeholder="E-mail Address" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                           <span class="col-md-1 col-md-offset-1 text-center" style="margin-top:10px;"><i class="fa fa-phone"></i></span>
                            <div class="col-md-8">
                                <input id="email" name="nummer" type="text" placeholder="Telefoonnummer" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                           <span class="col-md-1 col-md-offset-1 text-center" style="margin-top:10px;"><i class="fa fa-tag"></i></span>
                            <div class="col-md-8">
                                <input id="email" name="adres" type="text" placeholder="Adres" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                           <span class="col-md-1 col-md-offset-1 text-center" style="margin-top:10px;"><i class="fa fa-home"></i></span>
                            <div class="col-md-8">
                                <input id="email" name="woonplaats" type="text" placeholder="Woonplaats" class="form-control">
                            </div>
                        </div>

   
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-1 text-center" style="margin-top:10px;"><i class="fa fa-pencil-square-o bigicon"></i></span>
                            <div class="col-md-8">
                                <textarea class="form-control" id="message" name="message" placeholder="Uw vraag of opmerking" rows="7" style="margin-left:5px;"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Verstuur</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
// De data wordt uit het contact formulier gehaald en omgezet in variabelen.

$mail = $_POST['email'];
$naam = $_POST['name'];
$adres = $_POST['adres'];
$nummer = $_POST['nummer'];
$woonplaats = $_POST['woonplaats'];

// De data wordt ingevoerd in het mail form door middel van variabelen.
$to      = 'buitenlandseproducten@outlook.com';
$subject = 'U heeft mail ontvangen';
$headers = "U heeft mail ontvangen van " . "$mail" . ". Hieronder vindt u de inhoud";

$message = 
    "$naam heeft u een mail gestuurd.\r\n" . 
    "De gegevens van $naam zijn als volgt,\r\n" . 
    "Telefoonnummer:\r\n" . 
    "$nummer\r\n" . 
    "Adres:\r\n" . 
    "$adres\r\n" .
    "Woonplaats:\r\n" . 
    "$woonplaats\r\n" .
    "De vraag of opmerking van $naam is:\r\n {$_POST['message']}";

// Er wordt gechecked of er een mail adres is ingevoerd en als dit het geval is wordt er een mail verstuurd.
    if (strlen($mail) > 1) {
     mail($to, $subject, $message, $headers);
echo "Uw mail is verzonden!";};


?> 


<div class="container">
           <div class="row">
           <div class="col-sm-3">
<span class="glyphicon glyphicon-map-marker" style="font-size:20px;"> </span><hr>
<h5>Lovensdijkstraat 61-63<br>
       4818AJ Breda</h5></div>

           <div class="col-sm-3">
         <span class="glyphicon glyphicon-envelope" style="font-size:20px;"> </span><hr>
<h5>buitenlandseproducten@outlook.com</h5></div>

           <div class="col-sm-3">
     <span class="glyphicon glyphicon-phone" style="font-size:20px;"> </span><hr>
<h5>+316 4321234</h5></div>

  <div class="col-sm-3">

 				<a href="http://twitter.com/"><span class="fa fa-twitter" style="margin-right:40px;font-size:20px;"></span></a>
 				<a href="http://facebook.com/"><span class="fa fa-facebook" style="margin-top:10px;font-size:20px;"></span></a>
<hr>

<h5>Vragen? Stuur ons gerust een tweet!</h5></div>

            </div>
</div>

<div class="panel-footer">
</div>

<div id="googleMap"></div>


<!---------------------------GOOGLE MAPS SCRIPT + MARKER + JS SCROLL------------------------------------->


<script src="http://maps.googleapis.com/maps/api/js"></script>
<script>
var myCenter = new google.maps.LatLng(51.5857124,4.79106,17);

function initialize() {
var mapProp = {
center:myCenter,
zoom:11,
scrollwheel:false,
draggable:true,
mapTypeId:google.maps.MapTypeId.ROADMAP
};

var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

var marker = new google.maps.Marker({
position:myCenter,
});

marker.setMap(map);
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>

<?php
 

include ('includes/footer.html');
?>