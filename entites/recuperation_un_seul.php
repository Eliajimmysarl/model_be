<?php

try {
   
   $dbh = new PDO('mysql:host=localhost;dbname='.$db, $user, $pass);
   
   $stmt = $dbh->prepare("SELECT *FROM metamodele WHERE id = :id");
   
   $stmt->bindParam(':id', $id, PDO::PARAM_INT);
   
   $stmt->execute();
   
   $datas = array();
   
   while($resultat=$stmt->fetch(PDO::FETCH_ASSOC)) 
       {
           $datas["code"]  = 200;
           $datas['metamodele'][]=$resultat;
       }
           
   echo json_encode($datas);
     }
   catch (PDOException $e) {
       print "Erreur !: " . $e->getMessage() . "<br/>";
       die();
   }
  ?> 