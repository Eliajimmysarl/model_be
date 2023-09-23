<?php

    $myjson=file_get_contents('php://input');

    $json_decode= json_decode($myjson);

    $textes=$json_decode->text;

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_test, $user_test, $pass_test);

            for($i=0; $i < count($textes); ++$i)
                {
                    $id = $textes[$i][0];

                    $text = $textes[$i][1];
               
                    $select = $textes[$i][2];

                    $dates = $textes[$i][3];

                    $telephone = $textes[$i][4];
               
                    $email = $textes[$i][5];

                    $stmt = $dbh->prepare("UPDATE test SET texte=?, selec=?,  dates=?, telephone=?, email=? WHERE id=$id");

                    $stmt->bindParam(1, $texte);

                    $stmt->bindParam(2, $selec);

                    $stmt->bindParam(3, $dates);

                    $stmt->bindParam(4, $telephone);

                    $stmt->bindParam(5, $email);

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