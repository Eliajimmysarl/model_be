<?php

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_test, $user_test, $pass_test);

            $stmt = $dbh->prepare("SELECT *FROM test   ORDER BY id");

            $stmt->execute();

            $datas = array();

            while($resultat=$stmt->fetch(PDO::FETCH_ASSOC)) 
                {
                    $datas["code"]  = 200;
                    $datas['entite'][]=$resultat;
                }
                    
            echo json_encode($datas);
            
        }
    catch (PDOException $e) {
                print "Erreur !: " . $e->getMessage() . "<br/>";
                die();
    }
?> 