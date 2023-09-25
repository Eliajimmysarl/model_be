<?php

//Insertion dans la base des données
try {
   
$dbh = new PDO('mysql:host=localhost;dbname='.$db, $user, $pass);

$stmt = $dbh->prepare("SELECT titre.id, titre.descriptions, titre.periode, titre.prix, titre.zone, titre.service_id, commande.id, commande.reference_commande, commande.product_id, commande.service_id, commande.client_id, commande.payer, commande.description,carte.id_client, carte.id_carte, commande.date_enregistrement FROM `titre` INNER JOIN commande ON titre.id=commande.product_id INNER JOIN carte WHERE commande.client_id= $client AND carte.id_client= $client AND commande.payer='OUI';");

$stmt->bindParam(':id', $id, PDO::PARAM_INT);

$stmt->execute();

$datas = array();

while($resultat=$stmt->fetch(PDO::FETCH_ASSOC))
    {
        $dateRenouvellement=$resultat['date_enregistrement'];
       
        $createDate = new DateTime($dateRenouvellement);
       
$dateRenouvellement = $createDate->format('d-m-Y');

$heureRenouvellement = $createDate->format("H:i:s");

$semaineRenouvellement= date("W", strtotime($dateRenouvellement));

$annee = date('Y', strtotime($dateRenouvellement));

$semaine =$createDate->format("W");

$createDate->modify('next monday');

   $finSemaine=$createDate->format('d-m-Y');

$today = date("d-m-Y");

$moisRenouvvellement= date("m",strtotime($dateRenouvellement));

$moisAjourdhui= date("m",strtotime($today ));

$semaineAjourdhui= date("W",strtotime($today ));

$duree = $resultat['periode'];

if($duree =="1 mois")
{

$expiration=date("t-m-Y", strtotime($dateRenouvellement));
}
   else if($duree =="1 jour")
{
$expiration=$dateRenouvellement;
   }
else if($duree =="1 semaine")
{
$expiration=$finSemaine;
}

if(($duree =="1 mois") AND ($moisRenouvvellement==$moisAjourdhui))
{
$actif="ACTIF";
}
else if(($duree =="1 jour") AND ($dateRenouvellement==$today))
{
$actif="ACTIF";
}
else if(($duree =="1 semaine")AND ($semaineRenouvellement==$semaineAjourdhui))
{
   $actif="ACTIF";
}
else
{
$actif="SUSPENDED";
}
       
        $referenceCommande=$resultat['reference_commande'];
        $descriptions=$resultat['descriptions'];
        $idCarte=$resultat['id_carte'];
        $prix=$resultat['prix'];
       
       
        $datas["code"]  = 200;
        $datas['recharge'][]= ['heure' => $heureRenouvellement,'actif' => $actif, 'expiration' => $expiration, 'reference_commande' => $referenceCommande, 'descriptions' => $descriptions , 'id_carte' => $idCarte , 'prix' => $prix, 'date_enregistrement' =>  $dateRenouvellement, 'periode' => $duree];

       // $datas['recharge'][]=$resultat;
    }
          $datas["client"]  = $client;
echo json_encode($datas);
  }
catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
 
?>