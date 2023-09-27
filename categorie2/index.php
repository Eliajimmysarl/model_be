<?php
    include('../../connect/connect.php');

    include('../../module/curl.php');

    $headers = apache_request_headers();
    
    $token=$headers['Authorisation'];

    $myjson=file_get_contents('php://input');

    $json_decode= json_decode($myjson);

    $uri = $authority."/token/";
        
    $result=curl_get($uri,$token);

    $obj = json_decode($result);
        
    $code =  $obj->code;

    if($code !=200)
        {   
            $data["code"]  = 403;

            $data["message"]  = "Erreur 403 Forbidden:  Vous n'avez pas les permissions necessaires pour acceder a la ressource demandee";
        
            echo json_encode($data);  
        }
    else
        {
            $methode=$_SERVER['REQUEST_METHOD'];
   
            if($methode=='GET')
                {
              
                    require_once("recuperation_plusieurs.php");
                       
                }  
            else 
                {
                    $data["code"]  = 405;

                    $data["message"]  = "Erreur 405 :  Abscence de la méthode : GET";
                
                    echo json_encode($data);

                }
        }