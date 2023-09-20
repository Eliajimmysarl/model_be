<?php
//Recuperer le flux JSON envoyer
$myjson=file_get_contents('php://input');

//Decoder le flux JSON
$json_decode= json_decode($myjson);

$tde1=$json_decode->tde1; //prenom
$tde2=$json_decode->tde2; //nom
$tde3=$json_decode->tde3; //postnom


//Insertion dans la base des données
try {
$dbh = new PDO('mysql:host=localhost;dbname='.$db, $user, $pass);
$stmt = $dbh->prepare("UPDATE metamodele SET tde1=?, tde2=?, tde3=? WHERE id=?");

$stmt->bindParam(1, $tde1);
$stmt->bindParam(2, $tde2);
$stmt->bindParam(3, $tde3);
$stmt->bindParam(4, $id);
$stmt->execute();

$data["code"]  = 200;
$data["tde1"]  = "$tde1";
$data["tde2"]  = "$tde2";
$data["tde3"]  = "$tde3";


echo json_encode( $data );
 
  
    $dbh = null;
        
    }
catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>