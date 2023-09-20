<?php

    $myjson=file_get_contents('php://input');

    $json_decode= json_decode($myjson);

    $text=$json_decode->text;

    $select=$json_decode->select; 

    $date=$json_decode->date; 

    $telephone=$json_decode->telephone; 

    $email=$json_decode->email; 

    $password=$json_decode->password; 

    $optionsRadios=$json_decode->optionsRadios;

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_test, $user_test, $pass_test);

            $stmt = $dbh->prepare("INSERT INTO test (text, select, date, telephone, email, password, optionsRadios) VALUES (?,?,?,?,?,?,?)");

            $stmt->bindParam(1, $text);

            $stmt->bindParam(2, $select);

            $stmt->bindParam(3, $date);

            $stmt->bindParam(4, $telephone);

            $stmt->bindParam(5, $email);

            $stmt->bindParam(6, $password);

            $stmt->bindParam(7, $optionsRadios);

            $stmt->execute();

            $last = $dbh->lastInsertId();

            if($last==0)
                {
                    $data["code"]  = 400;

                    $data["message"]  = "Ressource not created";
                }
            else
                {
                    $data["code"]  = 201;

                    $data["id"]  = "$last";

                    $data["text"]  = "$text";

                    $data["select"]  = "$select";

                    $data["email"]  = "$email";

                    $data["date"]  = "$date";

                    $data["telephone"]  = "$telephone";

                    $data["optionsRadios"]  = "$optionsRadios";

                    $data["reponse"]  = "Le test $text $select avec l'id $id est cree";  
                }
            
            echo json_encode( $data );
        
            $dbh = null; 
        }

    catch (PDOException $e) 
        {
            print "Erreur !: " . $e->getMessage() . "<br/>";

            die();

        }
?>