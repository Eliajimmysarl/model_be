
<?php

//URI
$url = 'http://api.eliajimmy.net/text/';

if (isset($_FILES['clientExcel']) && is_uploaded_file($_FILES['clientExcel']['tmp_name']))
    {

        $origine = $_FILES['clientExcel']['tmp_name']; 
        $nomphoto = $_FILES['clientExcel']['name'];
        $destination = './'.$_FILES['clientExcel']['name'];
        move_uploaded_file($origine,$destination);

        if (function_exists('curl_file_create')) { // php 5.5+
            $cFile = curl_file_create($destination);
          } else { // 
            $cFile = '@' . realpath($destination);
          }

    }


$ch = curl_init();



// Setup request to send json via POST
$data = array(
    'fichier' => "excel", 
    'clientExcel'=> $cFile   

);

$authorization = "Authorisation:$token";
//Transform row int Json objet
$payload = json_encode($data);

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
   // curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

    curl_setopt($ch, CURLOPT_HTTPHEADER, array($authorization));

	// Set the content type to application/json
	//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/txt' , $authorization));
    
    // Return response instead of outputting
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result=curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    //echo  $result;

    $obj = json_decode($result);                      
    $clients= $obj->client;
    $code =  $obj->code;

    if($code ==201)
        {   
             
            //Intregration de l'IHM affichant la reponse positive
            require_once('composant/text/importer_excel/view/afficher_users.php'); 
        }
    

?>