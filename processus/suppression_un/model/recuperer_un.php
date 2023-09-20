<?php

$id=$_GET['id'];

//URI
$uri = $authority."/texte/".$id;

$result=curl_get($uri, $token);

    $obj = json_decode($result);                      
    $textes= $obj->texte;

    $code =  $obj->code;

    if($code ==200)
        {   

            $text= $textes[0]->text; 
            $text= $textes[0]->text;
            $text= $textes[0]->text;
            $id= $textes[0]->id;

            
            //Intregration de l'IHM affichant la reponse positive
            require_once('interactions/texte/supprimer/view/demande_suppression.php'); 
        }
        else
        {
            echo  $textes;  
        }




?>