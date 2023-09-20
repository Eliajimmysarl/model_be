<?php
$id=$_POST['id'];

$uri = $authority.'/text/'.$id;

//Recuperer les variables POST
$text=$_POST['text'];
$select=$_POST['select'];
$date=$_POST['date'];
$email=$_POST['email'];
$telephone=$_POST['telephone'];
$optionsRadios=$_POST['optionsRadios'];
//$password=$_POST['password'];
$password=password_hash($_POST['password'], PASSWORD_DEFAULT);
$mode="formulaire";



// Setup request to send json via POST
$data = array(
    
    'text' => $text,
    'select' => $select,
    'date' => $date,
	'email'=> $email,
	'telephone'=> $telephone,
    'password'=> $password,
    'optionsRadios'=> $optionsRadios

);    

$result=curl_put($uri, $token,$data);
     
    $textes=json_decode($result);
    $code =  $textes->code;
    if($code ==200)
        {   
          
                //Intregration de l'IHM affichant la reponse positive
                require_once('composant/text/modifier/view/reponse_positive.php'); 
            }
            else
            {
               echo  $code;  
            }
    
    
    
?>