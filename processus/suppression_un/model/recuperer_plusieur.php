<?php

$uri = $authority."/texte/";
   

$result=curl_get($uri, $token);

    $obj = json_decode($result);                      
    
    $textes= $obj->texte;

    $code =  $obj->code;

    if($code ==200)
        {   
             
            //Intregration de l'IHM affichant la reponse positive
            require_once('interactions/texte/supprimer/view/recuperation_plusieur.php'); 
        }
        else
        {
            echo $textes;  
        }


?>