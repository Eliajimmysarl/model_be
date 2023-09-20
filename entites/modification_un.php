<?php
//Recuperer le flux JSON envoyer
$myjson=file_get_contents('php://input');

//Decoder le flux JSON
$json_decode= json_decode($myjson);

$text=$json_decode->text; //texte
$select=$json_decode->select; //texte
$email=$json_decode->email; //texte
$date=$json_decode->date; //texte
$telephone=$json_decode->telephone; //texte
$optionsRadios=$json_decode->optionsRadios; //texte


//Insertion dans la base des données
try {
$dbh = new PDO('mysql:host=localhost;dbname='.$db_test, $user_test, $pass_test);
$stmt = $dbh->prepare("UPDATE metamodele SET text=?, select=?, email=? date=?, telephone=?, optionsRadios=? WHERE id=?");


$stmt->bindParam(1, $text);
$stmt->bindParam(2, $select);
$stmt->bindParam(3, $email);
$stmt->bindParam(4, $date);
$stmt->bindParam(5, $telephone);
$stmt->bindParam(6, $optionsRadios);
$stmt->bindParam(7, $id);

$stmt->execute();

$data["code"]  = 200;
$data["id"]  = "$last";
$data["text"]  = "$text";
$data["select"]  = "$select";
$data["email"]  = "$email";
$data["date"]  = "$date";
$data["telephone"]  = "$telephone";
$data["optionsRadios"]  = "$optionsRadios";


echo json_encode( $data );
 
  
    $dbh = null;
        
    }
catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>  