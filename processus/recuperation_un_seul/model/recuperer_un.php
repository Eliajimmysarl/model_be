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
            $text=$textes[0]->text; 

            $text=$textes[0]->text;

            $text=$textes[0]->text;

            $id=$textes[0]->id;

          
            require_once('interactions/texte/recuperer/view/recuperation_un.php'); 
        }
    else
        {
            echo  $textes;  
        }




?>