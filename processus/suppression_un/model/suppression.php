<?php

$id=$_GET['id'];

//URI
$uri = $authority."/texte/".$id;

$result=curl_delete($uri, $token);

    $obj = json_decode($result);                      
    $textes= $obj->texte;

    $code =  $obj->code;

    if($code ==200)
        {    
             
            //Intregration de l'IHM affichant la reponse positive
            require_once('interaction/texte/supprimer/view/reponse_positive.php'); 
        }
        else
        {
            echo  $texts;  
        }





?>