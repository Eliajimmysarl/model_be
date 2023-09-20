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
$stmt = $dbh->prepare("INSERT INTO metamodele (tde1, tde2, tde3) VALUES (?,?,?)");
$stmt->bindParam(1, $tde1);
$stmt->bindParam(2, $tde2);
$stmt->bindParam(3, $tde3);



$stmt->execute();

$last = $dbh->lastInsertId();
$retour = array();
$data["code"]  = 201;
$data["id"]  = "$last";
$data["tde1"]  = "$tde1";
$data["tde2"]  = "$tde2";
$data["tde3"]  = "$tde3";
$data["reponse"]  = "Le metamodele $tde1 $tde2 avec l'id $id est cree";

echo json_encode( $data );
  
  
    $dbh = null;
        
    }
catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>