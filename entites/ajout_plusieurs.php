<?php

    $myjson=file_get_contents('php://input');

    $json_decode= json_decode($myjson);

    $textes=$json_decode->text;

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_test, $user_test, $pass_test);

            for($i=0; $i < count($textes); ++$i)
                {
                    $text = $textes[$i][0];
               
                    $select = $textes[$i][1];

                    $stmt = $dbh->prepare("INSERT INTO test (texte, selec) VALUES (?,?)");

                    $stmt->bindParam(1, $text);
        
                    $stmt->bindParam(2, $select);  

                    $stmt->execute();
                }
            
            $last = $dbh->lastInsertId();
              
            if($last==0)
                {
                    $data["code"]  = 400;

                    $data["message"]  = "Ressource not created";
                }
            else
                {
                    $data["code"]  = 201;

                    $data["message"]  = "Ressource created";
                }
            
            echo json_encode($data);
        
            $dbh = null; 
        }
    catch (PDOException $e) 
        {
            print "Erreur !: " . $e->getMessage() . "<br/>";

            die();
        }
?>