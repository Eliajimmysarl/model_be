<?php    
    
    $texte = $_POST['texte'];

    $selec = $_POST['selec'];

    $file = $_FILES["excel"]["tmp_name"];
                    
    $fileName = $_FILES["excel"]["name"];
                    
    $file_open = fopen($_FILES['excel']['tmp_name'], "r");
                    
    $count = 0;
    
    if ($file_open) 
        {
                       
            try {
                   $dbh = new PDO('mysql:host=localhost;dbname='.$bd_test, $user_test, $pass_test);
                    
                    while(($csv = fgetcsv($file_open, 1000, ",")) !== false)
                         {
                            $exp = $csv[0];

                            $sep=explode(";",$exp);

                            $count = 0;

                            if($count > 0)
                                {
                                    $dates = addslashes($sep[0]);
                    
                                    $telephone = addslashes($sep[1]);

                                    $email = addslashes($sep[0]);
                    
                                    $passwords = addslashes($sep[1]);

                                    $optionsRadios = addslashes($sep[0]);
        
                                    $stmt = $dbh->prepare("INSERT INTO test (texte, selec, dates, telephone, email, passwords, optionsRadios) VALUES (?,?,?,?,?,?,?)");

                                    $stmt->bindParam(1, $texte);

                                    $stmt->bindParam(2, $selec);

                                    $stmt->bindParam(3, $dates);

                                    $stmt->bindParam(4, $telephone);

                                    $stmt->bindParam(5, $email);

                                    $stmt->bindParam(6, $passwords);

                                    $stmt->bindParam(7, $optionsRadios); 
                
                                    $stmt->execute();
                                }
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
        }
    else 
        {
            $data["code"]  = 400;
            
            $data["message"]  = "Unable to open file";
        }