<?php
// 
// showfile.php toont een afbeelding uit de tabel 'afbeelding' in de database.
// Het image_id van de afbeelding die getoond wordt, wordt gelezen uit de URL via GET.
// Gebruik:  showfile.php?image_id=1
//

// mysqli_connect.php bevat de inloggegevens voor de database.
// Per server is er een apart inlogbestand - localhost vs. remote server
        $DBServer = 'localhost';
        $DBUser   = 'WebwinkelF4';
        $DBPass   = 'groepf4';
        $DBName   = 'webwinkel-DB';



/*** some basic sanity checks ***/
if(filter_has_var(INPUT_GET, "image_id") !== false && filter_input(INPUT_GET, 'image_id', FILTER_VALIDATE_INT) !== false)
    {
    /*** assign the image id ***/
    $image_id = filter_input(INPUT_GET, "image_id", FILTER_SANITIZE_NUMBER_INT);
    try     {
        /*** connect to the database ***/
        $dbh = new PDO("mysql:host=".$DBServer.";dbname=".$DBName , $DBUser, $DBPass );

        /*** set the PDO error mode to exception ***/
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*** The sql statement ***/
        $sql = "SELECT image, image_type FROM afbeelding WHERE image_id=$image_id";

        /*** prepare the sql ***/
        $stmt = $dbh->prepare($sql);

        /*** exceute the query ***/
        $stmt->execute(); 

        /*** set the fetch mode to associative array ***/
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        /*** set the header for the image ***/
        $array = $stmt->fetch();

        /*** check we have a single image and type ***/
        if(sizeof($array) == 2)
            {
            /*** set the headers and display the image ***/
            header("Content-type: ".$array['image_type']);

            /*** output the image ***/
            echo $array['image'];
            }
        else
            {
            throw new Exception("Out of bounds Error");
            }
        }
    catch(PDOException $e)
        {
        echo $e->getMessage();
        }
    catch(Exception $e)
        {
        echo $e->getMessage();
        }
        }
  else
        {
        echo 'Please use a real id number';
        }
?>